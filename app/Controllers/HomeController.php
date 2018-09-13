<?php

namespace App\Controllers;

use \App\Models\User;

class HomeController
{
    public function index() {
        return view('home');
    }

    public function login($param) {
       return view('sections/login');
    }

    public function users() {
        $container = require(APP_PATH . 'container.php');
        $model = $container->create(User::class);
        $users = $model->all();
        foreach ($users as $user) {
            echo $user->name;
        }
    }
}