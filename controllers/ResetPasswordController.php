<?php

class ResetPasswordController {

    public function resetPassword () {

        $data = [
            'email' => trim($_POST['usersEmail']),
        ];

        
    }
}