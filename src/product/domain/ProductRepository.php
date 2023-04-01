<?php

namespace app\src\product\domain;

use app\src\product\domain\Product;
use app\src\product\domain\valueObjects\ProductId;

interface ProductRepository{

    public function all();

    public function findById(ProductId $id): ?Product;

    public function save(Product $product);

    public function update(ProductId $id, array $dataUpdate);

    public function delete(ProductId $id): ? Product;
}