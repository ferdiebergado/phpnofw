<?php

namespace App\Models;

use Core\BaseModel;
use Core\ModelInterface;
use Core\SessionManager;
use PDO;

class User extends BaseModel implements ModelInterface
{
    protected $guarded = [
        'password'
    ];

    public function all() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $this->guard($stmt->fetchAll());
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->guard($stmt->fetch());
    }

    public function update($id, array $fields)
    {
        $qstr = '';
        foreach ($fields as $key => $value) {
            $qstr = $qstr . $key . '= :' . $key . ',';
        }
        $qstr = rtrim($qstr, ',');
        $stmt = $this->db->prepare("UPDATE users SET " . $qstr . " WHERE id = :id");
        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $value, PDO::PARAM_STR);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $updated = $stmt->execute();
        if ($updated) {
            cache_forget('user_' . $id);
            cache_remember('user_' . $id, 30, $this->find($id));
            $this->updateSession($fields);
            logger("User $id updated.", 1);
        }
        return $updated;
    }

    public function latest($date = 'created_at') {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY ? DESC");
        $stmt->execute(array($date));
        return $this->guard($stmt->fetchAll());
    }

    public function login($email, $password) {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email AND active = true");
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        $hash = $user['password'];
        if(isset($user['id']) && password_verify($password, $hash)) {
            if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
                $newhash = password_hash($password, PASSWORD_DEFAULT);
                $this->update($user['id'], ['password' => $newhash]);
            }
            $user = $this->guard($user);
            $this->updateSession($user);
            $_SESSION['isLoggedIn'] = true;
            cache_remember('user_'.$user['id'], 30, $user);
            return true;
        }
        else {
            return false;
        }
    }

    private function updateSession(array $fields) {
        SessionManager::regenerateSession();
        foreach($fields as $key => $value) {
            $_SESSION['USER_' . strtoupper($key)] = htmlspecialchars($value);
        }
    }
}
