<?php

namespace app\src\product\application;

use app\src\product\domain\Product;
use app\src\product\domain\ProductRepository;
use app\src\product\domain\valueObjects\ProductId;

final class GetProductUseCase
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
     * Show Product.
     * @return Product
    */

    public function getProduct(int $productId) : ? Product
    {
        $productId = new ProductId($productId);

        return $this->repository->findById($productId);
    }
}