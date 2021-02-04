<?php

class AuthCest
{
    // tests
    public function tryToSendGet(ApiTester $I)
    {
        $I->sendGet('/login');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::METHOD_NOT_ALLOWED); //405
    }

    public function tryToAuthWithoutCredentials(ApiTester $I)
    {
        $I->sendPost('/login');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::UNAUTHORIZED); //401
    }

    public function tryToAuthWithInvalidCredentials(ApiTester $I)
    {
        $I->sendPost('/login');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::UNAUTHORIZED); //401
    }

    public function tryToAuthWithValidCredentials(ApiTester $I)
    {
        $I->sendPost('/login', ['username' => 'admin', 'password' => '@#$RF@!718']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); //200
        $I->seeResponseIsJson();
        $I->seeResponseContains("jwt");
    }
}
