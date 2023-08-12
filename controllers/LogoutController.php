<?php

class LogoutController {

    public function logout() {
        $this->removeUserSession();
        redirect("../login.php");
    }

    public function removeUserSession() {
        session_unset();
    }
}