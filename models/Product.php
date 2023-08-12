<?php
require_once '../Database.php';

class Product {

    private $productId;
    private $productName;
    private $productVersion;
    private $productColor;
    private $productPrice;
    private $productDescription;
    private $db;

    public function __construct($productId, $productName, $productVersion, $productColor, $productPrice, $productDescription) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productVersion = $productVersion;
        $this->productColor = $productColor;
        $this->productPrice = $productPrice;
        $this->productDescription = $productDescription;
     
        $this->db = new Database;
    }

    public function getAllProducts () {

        $this->db->query('SELECT * FROM products');

        $this->db->execute();

        $resultSet = $this->db->resultSet();

        return $resultSet;
    }
}