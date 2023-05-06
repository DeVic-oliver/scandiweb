<?php

require_once 'abstract/ProductBase.php';

class DVD extends ProductBase{

    private float $size;

    public function __construct(string $sku, string $name, float $price, string $type, array $args){
        parent::__construct($sku, $name, $price, $type);
        $this->size = $args['size'];
    }

    public function replaceHtmlStringMarkupsWithProductInfo( string $html ) : string
    {
        $tempCard = str_replace('{{sku}}', $this->sku, $html);
        $tempCard = str_replace('{{name}}', $this->name, $tempCard);
        $tempCard = str_replace('{{price}}', $this->price, $tempCard);
        $dvdInfo = "Size: $this->size MB";
        $tempCard = str_replace('{{info}}', $dvdInfo, $tempCard);
        return $tempCard;
    }

    public function setSize(float $size){
        $this->size = $size;
    } 

    public function getSize() : float
    {
        return $this->size;
    }
}