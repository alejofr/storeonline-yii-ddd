<?php

namespace app\src\product\application;

use app\src\product\domain\Product;
use app\src\product\domain\valueObjects\ProductDescription;
use app\src\product\domain\valueObjects\ProductName;
use app\src\product\domain\valueObjects\ProductPrice;
use app\src\product\domain\valueObjects\ProductStock;
use app\src\product\domain\ProductRepository;

final class CreateProductUseCase
{
    private $repository;

    /**
     * Repository injection.
     * @param ProductRepository
    */

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create Product.
     * @param string string $name, string $description, int $stock, float $price
     * @return Product created
    */

    public function registerProduct(string $name, string $description, int $stock, float $price)
    {
        $name = new ProductName($name);
        $description = new ProductDescription($description);
        $stock = new ProductStock($stock);
        $price = new ProductPrice($price);
        $product = Product::create($name, $description, $stock, $price);

        return $this->repository->save($product);
    }
}