<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController {
    private $user;

    public function __construct(User $user) {
        $this->middleware('auth', 'active');
        $this->user = $user;
    }

    public function edit() {
        $title = 'Edit User';
        return view('user/edit', compact('title'));
    }

    public function update($param) {
        if (empty($_POST["name"])) {
            $_SESSION['errors']['name'] = 'Name is required';
        } else {
            $name = $_POST["name"];
            $_SESSION['name'] = $name;
        }

        if (empty($_POST["email"])) {
            $_SESSION['errors']['email'] = 'Email is required';
        } else {
            $email = $_POST["email"];
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors']['email'] = "Invalid email format";
            }
            $_SESSION['email'] = $email;
        }
        if (empty($_SESSION['errors'])) {
            $id = $param['id'];
            if ($this->user->update($id, compact('name', 'email'))) {
                $user = $this->user->find($id);
                cache_remember('user_' . $id, 30, $user);
                $this->updateSession($this->guard($user));
                logger("User $id updated.", 1);
                $_SESSION['message']['title'] = 'User updated.';
                $_SESSION['message']['type'] = 'success';
                return header('Location: /');
            }
        } else {
            return back();
        }
    }
}
