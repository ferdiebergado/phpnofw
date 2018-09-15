<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        if (isset($_SESSION['isLoggedIn'])) {
            $title = 'Home';
            return view('home', compact('title'));
        } else {
            $title = 'Login';
            return view('login', compact('title'), true);
        }
    }
}
