<?php
namespace App\Controllers;

use App\Models\User;

class LoginController {

    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login() {
        if (empty($_POST["email"])) {
            $_SESSION['errors']['email'] = 'Email is required';
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors']['email'] = "Invalid email format";
            }
            $_SESSION['email'] = $email;
        }

        if (empty($_POST["password"])) {
            $_SESSION['errors']['password'] = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }

        if (empty($_SESSION['errors']['email']) && empty($_SESSION['errors']['password'])) {
            if (verify_token($_POST['csrf_token'])) {
                $success = $this->user->login($email, $password);
                if (!$success) {
                    $_SESSION['errors']['email'] = 'Invalid username or password.';
                }
            }
        }
        return header('Location: /');
    }
    public function logout() {
        if (verify_token($_POST['csrf_token'])) {
            session_unset();
            session_destroy();
            return header('Location: /');
        }
    }
}
