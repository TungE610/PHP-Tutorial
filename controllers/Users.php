<?php

    require_once '../models/User.php';
    require_once '../helpers/session_helper.php';
    require_once 'RegisterUserController.php';
    require_once 'LoginController.php';
    require_once 'LogoutController.php';
    require_once 'ResetPasswordController.php';

    class Users {

        private $userModel;
        
        public function __construct(){
            $this->userModel = new User;
        }

        public function register(){

            $registerUserController = new RegisterUserController;
            $registerUserController->register();
        }

        public function login() {
            $loginController = new LoginController;
            $loginController->login();
        }

        public function logout() {
            $logoutController = new LogoutController;
            $logoutController->logout();
        }

        public function resetPassword() {
            $resetPasswordController = new ResetPasswordController;
            $resetPasswordController->resetPassword();
        }


}

    $init = new Users;

    //Ensure that user is sending a post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        switch($_POST['type']){
            case 'register':
                $init->register();
                break;
            case 'login':
                $init->login();
                break;
            case 'send':
                $init->resetPassword();
            default:
            redirect("../index.php");
        }
    } else{
        switch($_GET['q']){
            case 'logout':
                $init->logout();
                break;
            default:
            redirect("../index.php");
        }
    }

    