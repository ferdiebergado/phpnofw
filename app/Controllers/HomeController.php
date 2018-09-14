<?php

namespace App\Controllers;

use App\Models\User;

class HomeController
{
    private $user, $content;

    public function __construct(User $user) {
        $this->user = $user;
        $this->content = '';
    }

    public function index() {
        if (isset($_SESSION['isLoggedIn'])) {
            return view('home');
        } else {
            return view('login');
        }
    }

    public function login($param) {
     return view('sections/login');
 }

 public function users() {
    $this->content = $this->user->all();
    return view('home', $this->content);
}

public function user($param) {
    $this->content = $this->user->find($param['id']);
    return view('home', $this->content);
}

public function latestusers() {
    $users = $this->user->latest();
    return view('home', $this->content);
}
}
