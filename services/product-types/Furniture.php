<?php

require_once 'abstract/ProductBase.php';

class Furniture extends ProductBase{

    private float $height;
    private float $width;
    private float $length;

    public function __construct(string $sku, string $name, float $price, string $type, array $args){
        parent::__construct($sku, $name, $price, $type);
        $this->height = $args['height'];
        $this->width = $args['width'];
        $this->length = $args['length'];
    }

    public function replaceHtmlStringMarkupsWithProductInfo( string $html ) : string
    {
        $tempCard = str_replace('{{sku}}', $this->sku, $html);
        $tempCard = str_replace('{{name}}', $this->name, $tempCard);
        $tempCard = str_replace('{{price}}', $this->price, $tempCard);
        $furnitureInfo = "Dimensions: $this->height x $this->width x $this->length";
        $tempCard = str_replace('{{info}}', $furnitureInfo, $tempCard);
        return $tempCard;
    }

    public function setHeight(float $height){
        $this->height = $height;
    } 

    public function getHeight() : float
    {
        return $this->height;
    }

    public function setWidth(float $width){
        $this->width = $width;
    } 

    public function getWidth() : float
    {
        return $this->width;
    }

    public function setLength(float $length){
        $this->length = $length;
    } 

    public function getLength() : float
    {
        return $this->length;
    }
}