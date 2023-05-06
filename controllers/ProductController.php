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
            foreach ($products as $product) {
                $tempCard = str_replace('{{sku}}', $product['sku'], $card);
                $tempCard = str_replace('{{name}}', $product['name'], $tempCard);
                $tempCard = str_replace('{{price}}', $product['price'], $tempCard);

                if($product['type'] == 'furniture'){
                    $infoHtml = "Dimensions: $product[height]x$product[width]x$product[length]";
                    $tempCard = str_replace('{{info}}', $infoHtml, $tempCard);
                }

                if($product['type'] == 'dvd'){
                    $infoHtml = "Size: $product[size] MB";
                    $tempCard = str_replace('{{info}}', $infoHtml, $tempCard);
                }

                if($product['type'] == 'book'){
                    $infoHtml = "Weight: $product[weight]";
                    $tempCard = str_replace('{{info}}', $infoHtml, $tempCard);
                }

                $cards .= $tempCard;
            }

            $this->html = str_replace('{{list}}', $cards, $this->html);
            
        }
        
        public function addProduct(){
            $this->html = file_get_contents(PROJECT_ROOT . 'views/product-add.html');
        }

        public function storeProduct(){
            if(isset($_REQUEST) && !empty($_REQUEST['product_sku'])){
                Product::saveProduct($_REQUEST);
                header('Location: /scandiweb/?class=ProductController&method=addProduct');
            }
        }
        
        public function deleteProducts(){
            if(isset($_REQUEST)){
                $skuArr = $this->getSkusToDelete($_REQUEST);
                Product::deleteProducts($skuArr);
                header('Location: /scandiweb/');
            }
        }

        private function getSkusToDelete($arr = []) : array
        {
            $onlySkusArr = $this->getOnlyIndexThatBeginWithSKU($arr);
            return array_values($onlySkusArr);
        }

        private function getOnlyIndexThatBeginWithSKU($arr = []) : array
        {
            $skuArr = array_filter($_REQUEST, function($key) {
                return strpos($key, 'sku_') === 0;
            }, ARRAY_FILTER_USE_KEY);
            return $skuArr;
        }

        public function show(){
            echo $this->html;
        }
    }