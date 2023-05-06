<?php
function productTypesAutoload($className) {
    include 'product-types/' . $className . '.php';
}
spl_autoload_register('productTypesAutoload');

class ProductCardRenderer{
    
    private $card;

    public function __construct(){
        $this->card = file_get_contents(PROJECT_ROOT . 'views/product/product-card.html');
    }

    public function renderProductsIntoString($arr = []) : string
    {
        $cardsString = '';
        foreach ($arr as $product) {
            if(class_exists($product['type'])){
                $filteredProduct = array_filter($product, function($value) {
                    return !is_null($value);
                });
                $className = $product['type'];
                $productObject = new $className($product['sku'], $product['name'], $product['price'], $product['type'], $filteredProduct);
                $cardsString .= $productObject->replaceHtmlStringMarkupsWithProductInfo($this->card);
            }
        }
        return $cardsString;
    }
}