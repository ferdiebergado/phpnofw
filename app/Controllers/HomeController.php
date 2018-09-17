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
    public function send_mail() {
        ob_start();
        // include VIEW_PATH . 'sections/bsheader.php';
        include VIEW_PATH . 'email.php';
        // include VIEW_PATH . 'sections/bsfooter.php';
        $m = ob_get_contents();
        ob_end_clean();
        \Core\Mail::send('ferdiebergado@yahoo.com', 'Test email', $m);
        return header('Location: /');
    }
}
