<?php

namespace App\Models;

use Core\BaseModel;
use PDO;

class User extends BaseModel
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

    public function update(array $fields)
    {
        $stmt = $this->db->prepare("UPDATE users SET ");

    }

    public function latest($date = 'created_at') {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY ? DESC");
        $stmt->execute(array($date));
        return $stmt->fetchAll();
    }

    public function login($email, $password) {
        $query = $this->db->prepare("SELECT * FROM `users` WHERE `email` = :email");
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        // $query = null;
        if(isset($user['id']) && password_verify($password, $user['password'])) {
            session_regenerate_id();
            $_SESSION['USER_ID'] = $user['id'];
            $_SESSION['USER_NAME'] = $user['name'];
            $_SESSION['USER_EMAIL'] = $user['email'];
            $_SESSION['USER_CREATED_AT'] = $user['created_at'];
            $_SESSION['LAST_LOGIN'] = $user['last_login'];
            $_SESSION['isLoggedIn'] = true;
            return true;
        }
        else {
            return false;
        }
    }

}
