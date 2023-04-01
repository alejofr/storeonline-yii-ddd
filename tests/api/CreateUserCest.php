<?php
use Codeception\Util\HttpCode;

class CreateUserCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function createNewUser(ApiTester $I){
        $I->sendPost('users', $this->data());
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                'id'         => 'integer',
                'name'       => 'string',
                'email'      => 'string',
                'password'   => 'string'
            ]
        );
    }

    private function data()
    {
        return [
            'name' => "Test Cest Api",
            'email' => "test@email.com",
            'password' => "12345"
        ];
    }
}
