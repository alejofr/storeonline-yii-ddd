<?php

namespace app\models;

use yii\base\Model;

class ProductUpdate extends Model
{
    public $name;
    public $description;
    public $stock;
    public $price;

    public function rules()
    {
        return [
            // los atributos 'name', 'description', string
            [['name', 'description'], 'string'],

            // el atributo stock debe ser un valor numerico entero
            ['stock', 'number'],
            ['stock', 'integer'],
            // el atributo price debe ser un valor numerico flotante
            ['price', 'number'],
            ['price', 'double'],
            ['price', 'match', 'pattern' => '/^-?[0-9]+(?:\.[0-9]{1,2})+$/'],
        ];
    }
}