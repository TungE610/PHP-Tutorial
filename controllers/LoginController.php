<?php

    require_once '../helpers/session_helper.php';
    require_once '../models/User.php';

    class LoginController {

        private $userModel;
        
        public function __construct() {
            $this->userModel = new User;
        }

        public function login () {

            $data = [
                'name/email' => trim($_POST['name/email']),
                'usersPwd' => trim($_POST['usersPwd']),
            ];

            if(empty($data['name/email']) || empty($data['usersPwd'])){
                flash("login", "Please fill out all inputs");
                redirect("../login.php");
            }

            if($this->userModel->findUserByEmailOrUsername($data['name/email'], $data['name/email'])){
                //User Found
                $loggedInUser = $this->userModel->login($data['name/email'], $data['usersPwd']);
                if($loggedInUser){
                    //Create session
                    $this->createUserSession($loggedInUser);
                }else{
                    flash("login", "Password Incorrect");
                    redirect("../login.php");
                }
            }else{
                flash("login", "No user found");
                redirect("../login.php");
            }
        }

        public function createUserSession($user){
            $_SESSION['usersId'] = $user->usersId;
            $_SESSION['usersName'] = $user->usersName;
            $_SESSION['usersEmail'] = $user->usersEmail;
            redirect("../index.php");
        }
    }