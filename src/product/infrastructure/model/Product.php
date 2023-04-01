<?php

namespace app\src\product\infrastructure\model;

use InvalidArgumentException;
use yii\db\ActiveRecord;

class Product extends ActiveRecord{


    /**
     * @return string the name of the table associated with this ActiveRecord class.
    */
    
    public static function tableName()
    {
        return 'products';
    }

    public static function findOrFail($id){

        $product = self::findOne($id);

        if( $product != null ){
            return $product;
        }

        throw new InvalidArgumentException(sprintf('Does not exit any instance of product with the give id', static::class, $id), 404);
    }


    public function checkIsName($value)
    {
        $product = static::findOne(['name' => $value]);

        if($product != null ){
            throw new InvalidArgumentException(sprintf('The name has already been taken.', static::class, $value), 403);
        }

        
    }

}