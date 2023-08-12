<?php
require_once '../Database.php';

class User {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findUserByEmailOrUserName($email, $username) {

        $this->db->query('SELECT * FROM users WHERE usersUid = :username OR usersEmail = :email');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // check row

        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    } 

    public function register($data) {
        $this->db->query('INSERT INTO users (usersName, usersEmail, usersUId, usersPwd)
        VALUE (:name, :email, :Uid, :password)');

        $this->db->bind(':name', $data['usersName']);
        $this->db->bind(':email', $data['usersEmail']);
        $this->db->bind(':Uid', $data['usersUid']);
        $this->db->bind(':password', $data['usersPwd']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($nameOrEmail, $password){
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail);

        if($row == false) return false;

        $hashedPassword = $row->usersPwd;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }
}      