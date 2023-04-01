<?php

namespace app\src\product\application;

use app\src\product\domain\Product;
use app\src\product\domain\ProductRepository;
use app\src\product\domain\valueObjects\ProductId;

final class UpdateProductUseCase
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
     * Update Product.
     * @return Product
    */

    public function updateProduct(int $productId, array $dataUpdate)
    {
        $productId = new ProductId($productId);
        return $this->repository->update($productId, $dataUpdate);
    }
}