<?php

namespace app\src\product\domain;

use app\src\product\domain\valueObjects\ProductDescription;
use app\src\product\domain\valueObjects\ProductName;
use app\src\product\domain\valueObjects\ProductPrice;
use app\src\product\domain\valueObjects\ProductStock;

final class Product
{
    private $name;
    private $description;
    private $stock;
    private $price;

    /**
     * Product constructor.
     * @param string $name, $description, $stock and $price
    */


    public function __construct(ProductName $name, ProductDescription $description, ProductStock $stock, ProductPrice $price)
    {
        $this->name              = $name;
        $this->description       = $description;
        $this->stock             = $stock;
        $this->price             = $price;
    }


    public function name(): ProductName
    {
        return $this->name;
    }

    
    public function description(): ProductDescription
    {
        return $this->description;
    }


    public function stock(): ProductStock
    {
        return $this->stock;
    }

    public function price(): ProductPrice
    {
        return $this->price;
    }


    /**
     * Product create object.
     * @return object $Product
    */

    public static function create( ProductName $name, ProductDescription $description, ProductStock $stock, ProductPrice $price ): Product
    {
        $product = new self($name, $description, $stock, $price);

        return $product;
    }
}