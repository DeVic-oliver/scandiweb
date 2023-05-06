<?php
    require './config.php';
    require './models/Product.php';

    class ProductController{
        
        private $html;

        function __construct()
        {
            $this->listProducts();
        }
        
        public function listProducts(){
            $this->html = file_get_contents(PROJECT_ROOT . 'views/product-list.html');
        }
        
        public function addProduct(){
            $this->html = file_get_contents(PROJECT_ROOT . 'views/product-add.html');
        }
        
        public function show(){
            echo $this->html;
            var_dump(Product::getAllProducts());
        }
    }