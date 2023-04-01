<?php

use Codeception\Util\HttpCode;

class ProductCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('Authorization', 'Bearer wBthXkcjCPb4daixMkrFgHNASZYzzyhI'); // insertar token de acceso
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function getAllProducts(ApiTester $I) {
        

        $I->sendGet('products');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseIsValidOnJsonSchemaString('{"type":"array"}');
        $validResponseJsonSchema = json_encode(
            [
                'id'         => 'integer',
                'name'       => 'string',
                'description'=> 'string',
                'stock'      => 'integer',
                'price'      => 'float'
            ]
        );
        $I->seeResponseIsValidOnJsonSchemaString($validResponseJsonSchema);
    }

    public function createNewProduct(ApiTester $I){

        $I->sendPost('products', $this->data());
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                'id'         => 'integer',
                'name'       => 'string',
                'description'      => 'string',
                'stock'   => 'integer',
                'price' => 'float'
            ]
        );
    }

    public function getProduct(ApiTester $I) {

        $I->sendGet('products/1');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseIsValidOnJsonSchemaString('{"type":"object"}');
        $validResponseJsonSchema = json_encode(
            [
                'id'         => 'integer',
                'name'       => 'string',
                'description'      => 'string',
                'stock'   => 'integer',
                'price' => 'float'
            ]
        );
        $I->seeResponseIsValidOnJsonSchemaString($validResponseJsonSchema);
    }

    public function updateProduct(ApiTester $I) {

        $I->sendPatch('products/1', ['name' => $this->data()['name']]);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['name' => $this->data()['name']]);
    }

    public function deleteProduct(ApiTester $I) {

        $I->sendDelete('products/1');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseIsValidOnJsonSchemaString('{"type":"object"}');
        $validResponseJsonSchema = json_encode(
            [
                'id'         => 'integer',
                'name'       => 'string',
                'description'      => 'string',
                'stock'   => 'integer',
                'price' => 'float'
            ]
        );

        $I->seeResponseIsValidOnJsonSchemaString($validResponseJsonSchema);
        
    }

    private function data()
    {
        return [
            'name' => "Test Product",
            'description' => "Test description",
            'stock' => 12,
            "price" => 1.5,
            'accsess_token' => 'wBthXkcjCPb4daixMkrFgHNASZYzzyhI'
        ];
    }
}
