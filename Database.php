<?php

class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '12345678';
    private $dbname = 'practice';

    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {

        // set DSN : data source name - contains infomation needed to link to a database

        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;

        $options = array(
            PDO::ATTR_PERSISTENT=>true, // always check for an existing pdo collection before creating a new one
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // handle errors in pdo
        );

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        
        }catch(PDOException $e) {

            $this->error = $e->getMessage();
            echo $this->error;
        };
    }

    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        return $this->stmt->execute();
    }

    //Return multiple records
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount() {
        $this->execute();
        return $this->stmt->rowCount();
    }
}