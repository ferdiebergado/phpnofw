<?php

namespace App\Models;

use Core\BaseModel;
use Core\ModelInterface;
use Core\SessionManager;
use PDO;

class User extends BaseModel implements ModelInterface
{
    public function all() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update($id, array $fields)
    {
        $stmt = $this->db->prepare("UPDATE users SET name=:name, email=:email WHERE id = :id");
        $stmt->bindParam(':name', $fields['name'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $fields['email'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $updated = $stmt->execute();
        if ($updated) {
            $this->updateSession($fields);
        }
        return $updated;
    }

    public function latest($date = 'created_at') {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY ? DESC");
        $stmt->execute(array($date));
        return $stmt->fetchAll();
    }

    public function login($email, $password) {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email AND active = true");
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        if(isset($user['id']) && password_verify($password, $user['password'])) {
            $this->updateSession($user);
            $_SESSION['isLoggedIn'] = true;
            return true;
        }
        else {
            return false;
        }
    }
    private function updateSession(array $fields) {
        SessionManager::regenerateSession();
        foreach($fields as $key => $value) {
            if (($key !== 'password')) {
                $_SESSION['USER_' . strtoupper($key)] = $value;
            }
        }
    }
}
