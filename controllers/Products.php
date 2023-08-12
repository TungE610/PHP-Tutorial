<?php
require_once '../models/products.php';

class Products {

    private $productModel;

    public function __construct() {

        $this->productModel = new Product;
    }

    public function showAllProducts () {

        $allProducts = $this->productModel->getAllProducts();
    }
}

$init = new Products;
