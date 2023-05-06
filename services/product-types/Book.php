<?php 

require_once 'abstract/ProductBase.php';

class Book extends ProductBase{
    
    private float $weight;

    public function __construct(string $sku, string $name, float $price, string $type, array $args){
        parent::__construct($sku, $name, $price, $type);
        $this->weight = $args['weight'];
    }

    public function setWeigth(float $weight){
        $this->weight = $weight;
    } 

    public function getWeight() : float
    {
        return $this->weight;
    }

    public function replaceHtmlStringMarkupsWithProductInfo( string $html ) : string
    {
        $tempCard = str_replace('{{sku}}', $this->sku, $html);
        $tempCard = str_replace('{{name}}', $this->name, $tempCard);
        $tempCard = str_replace('{{price}}', $this->price, $tempCard);
        $bookInfo = "Weight: $this->weight";
        $tempCard = str_replace('{{info}}', $bookInfo, $tempCard);
        return $tempCard;
    }

}