<?php
    require './config.php';
    require './models/Product.php';
    require './services/ProductCardRenderer.php';

    class ProductController{
        
        private $html;

        function __construct()
        {
            $this->listProducts();
        }
        
        public function listProducts(){
            $this->html = file_get_contents(PROJECT_ROOT . 'views/product/product-list.html');
            
            $products = Product::getAllProducts();
            $renderer = new ProductCardRenderer();
            $cardsString = $renderer->renderProductsIntoString($products);
            $this->html = str_replace('{{list}}', $cardsString, $this->html);
        }
        
        public function addProduct(){
            $this->html = file_get_contents(PROJECT_ROOT . 'views/product/product-add.html');
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