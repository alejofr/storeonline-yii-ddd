<?php

namespace app\src\product\application;

use app\src\product\domain\ProductRepository;

final class AllProductUseCase
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
     * All Product.
     * @return Array[Product]
    */

    public function allProduct()
    {
        return $this->repository->all();
    }
}