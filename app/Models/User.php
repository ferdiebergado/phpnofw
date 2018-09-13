<?php

namespace App\Models;

use \App\Models\BaseModel;

class User extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }
    public function all() {
        $this->pdo->prepare("SELECT * FROM users");
        die(print_r($this->pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS)));
        $this->pdo->execute();
        $users = $this->pdo->fetchAll();
        return $users;
    }
}