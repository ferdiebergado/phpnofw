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
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['isLoggedIn'] = true;
            return true;
        }
        else {
            return false;
        }
    }
}
