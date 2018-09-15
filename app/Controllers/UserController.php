<?php
namespace App\Controllers;
use App\Models\User;

class UserController {
    public function edit() {
        $title = 'Edit User';
        return view('user/edit', compact('title'));
    }
    public function update($param, User $user) {
        if (empty($_POST["name"])) {
            $_SESSION['errors']['name'] = 'Name is required';
        } else {
            $_SESSION['name'] = test_input($_POST["name"]);
        }

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
        $user->update($_POST, $param['id']);
    }
}
