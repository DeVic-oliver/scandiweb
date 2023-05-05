<?php
    require './config.php';

    class ProductController{
        
        private $html;

        function __construct()
        {
            $this->html = file_get_contents(PROJECT_ROOT . 'views/product-list.html');
        }

        public function show(){
            echo $this->html;
        }

        public function listProducts(){
        }

    }