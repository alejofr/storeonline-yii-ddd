<?php

namespace app\models;

use yii\base\Model;

class ProductCreate extends Model
{
    public $name;
    public $description;
    public $stock;
    public $price;

    public function rules()
    {
        return [
            // los atributos 'name', 'description', 'stock', 'price' obligatorios
            [['name', 'description', 'stock', 'price'], 'required'],

            // el atributo stock debe ser un valor numerico entero
            ['stock', 'number'],
            ['stock', 'integer'],
            // el atributo price debe ser un valor numerico flotante
            ['price', 'number'],
            ['price', 'double'],
            ['price', 'match', 'pattern' => '/^-?[0-9]+(?:\.[0-9]{1,2})+$/'],
            // el email debe ser unico
            ['name', 'isUnique'],
        ];
    }

    /**
     * Validates the name.
     * is name in unique.
     *  @var string $attribute in field request
    */

    public function isUnique($attribute, $params)
    {
        $query = new \yii\db\Query();

        $product = $query->from('products')->where('name=:name', [':name' => $this->name])->count();

        if( $product > 0 ){
            $this->addError($attribute, 'The name has already been taken.');
        }
    }
}