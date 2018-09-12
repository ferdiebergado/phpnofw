<?php

namespace App\Controllers;

use \Symfony\Component\HttpFoundation\Request;

class HomeController
{
    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function index() {
        return view('home');
    }

    public function user($param) {
        echo 'User' . $param['id'];
    }
}