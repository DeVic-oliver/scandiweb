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
            $this->html = file_get_contents(PROJECT_ROOT . 'views/product/product-list.html');
            $card = file_get_contents(PROJECT_ROOT . 'views/product/product-card.html');
            
            $cards = '';
            $products = Product::getAllProducts();
            foreach ($products as $value) {
                $tempCard = str_replace('{{sku}}', $value['sku'], $card);
                $tempCard = str_replace('{{name}}', $value['name'], $tempCard);
                $tempCard = str_replace('{{price}}', $value['price'], $tempCard);
                $cards .= $tempCard;
            }

            $this->html = str_replace('{{list}}', $cards, $this->html);
            
        }
        
        public function addProduct(){
            $this->html = file_get_contents(PROJECT_ROOT . 'views/product-add.html');
        }
        
        public function show(){
            echo $this->html;
        }
    }