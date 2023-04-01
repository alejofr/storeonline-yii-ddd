<?php

namespace app\src\product\infrastructure\repositories;

use app\src\product\domain\Product;
use app\src\product\domain\ProductRepository;
use app\src\product\domain\valueObjects\ProductDescription;
use app\src\product\domain\valueObjects\ProductId;
use app\src\product\domain\valueObjects\ProductName;
use app\src\product\domain\valueObjects\ProductPrice;
use app\src\product\domain\valueObjects\ProductStock;
use app\src\product\infrastructure\model\Product as ActiveRecordProductModel;

final class RecordPatternProduct implements ProductRepository{
    private $activeRecordProductModel;

    /**
     * Product model injection.
     * @param Product
    */


    public function __construct()
    {
        $this->activeRecordProductModel = new ActiveRecordProductModel();
    }

    public function all()
    {
        return $this->activeRecordProductModel->find()->all();
    }
    
    public function save(Product $product)
    {
        $newProduct = $this->activeRecordProductModel;

        $newProduct->name = $product->name()->value();
        $newProduct->description = $product->description()->value();
        $newProduct->stock = $product->stock()->value();
        $newProduct->price = $product->price()->value();

        if( $newProduct->save(false) )
            return $newProduct;

    }

    public function findById(ProductId $id): ?Product
    {
        $product = $this->activeRecordProductModel->findOrFail($id->value());

        // Return Domain Product model
        return new Product(
           new ProductName($product->name),
           new ProductDescription($product->description),
           new ProductStock($product->stock),
           new ProductPrice($product->price)
        );
    }

    public function update(ProductId $id, array $dataUpdate)
    {
        $product = $this->activeRecordProductModel->findOrFail($id->value());

        foreach ($dataUpdate as $key => $value) {
            if( $product[$key] !== $value ){
                if( $key == 'name' ){
                    $this->activeRecordProductModel->checkIsName($value);
                }

                $product[$key] = $value;
            }
        }

        if( $product->save(false) )
            return $product;
    }

    
    

    public function delete(ProductId $id): ? Product
    {
        $product = $getProduct = $this->activeRecordProductModel->findOrFail($id->value());
        $getProduct->delete();

        // Return Domain Product model
        return new Product(
            new ProductName($product->name),
            new ProductDescription($product->description),
            new ProductStock($product->stock),
            new ProductPrice($product->price)
         );
    }

}