<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        if (isset($_SESSION['isLoggedIn'])) {
            $title = 'Home';
            return view('home', compact('title'));
        } else {
            return header('Location: /login');
        }
    }
}
