<?php
class Users extends Controller {
    
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {

        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data

            //TODO change string filter
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters and numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a valid username';
            } elseif (!preg_match($nameValidation,$data['username'])) {
                $data['usernameError'] = 'Username can only contain letters and numbers';
            }

            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter a valid email address';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken';
                }
            }

            //Validate password on length and numeric values.
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 6) {
                $data['passwordError'] = 'Password must be at least 6 characters';
            } elseif (preg_match($passwordValidation,$data['password'])) {
                $data['passwordError'] = 'Password must have at least one numeric value.';
            }

            //Validate confirm password.
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter a password.';
            } else {
                if ($data['confirmPassword'] != $data['password']) {
                    $data['confirmPasswordError'] = 'Passwords to not match, please try again.';
                }
            }
            // Make sure that errors are empty
            if (empty($data['confirmPasswordError']) && empty($data['usernameError']) && empty($data['passwordError'])) {
                // Hash password
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                // Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to login page
                    header('Location: '. URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }

        $this->view('users/register', $data);
    }

    public function login() {

        $data = [
            'title' =>'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); //! this is depreciated, fix it 

            $data = [
                'title' =>'Login page',
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => ''
            
            ];

            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['username'],$data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Username is or password is incorrect. <br> Please try again.';

                    $this->view('users/login', $data);
                }
            }

        }
        // Deleting this broke everything before, but i dont think it should cause an issue now.
        // else {
        //     $data = [
        //         'title' =>'Login page',
        //         'username' => '',
        //         'password' => '',
        //         'usernameError' => '',
        //         'passwordError' => ''
        //     ];
        // }
        $this->view('users/login', $data);
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->ID;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        header('Location: '. URLROOT . '/pages/index');
    }
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('Location: '. URLROOT . '/users/login');


    }
}