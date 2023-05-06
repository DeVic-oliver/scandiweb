<?php

abstract class ProductBase{
    protected string $sku;
    protected string $name;
    protected float $price;
    protected string $type;

    public function __construct(string $sku, string $name, float $price, string $type){
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
    }

    abstract public function replaceHtmlStringMarkupsWithProductInfo( string $html );
    
    public function setSku(string $sku){
        $this->sku = $sku;
    }

    public function getSku() : string
    {
        return $this->sku;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }
    
    public function setPrice(float $price){
        $this->price = $price;
    }

    public function getPrice() : float
    {
        return $this->price;
    }

    public function setType(string $type){
        $this->type = $type;
    }

    public function getType() : string
    {
        return $this->type;
    }
    
}