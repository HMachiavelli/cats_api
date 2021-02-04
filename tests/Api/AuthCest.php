<?php

class AuthCest
{
    // tests
    public function tryToSendGet(ApiTester $I)
    {
        $I->sendGet('/auth');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::METHOD_NOT_ALLOWED); //405
    }

    public function tryToAuth(ApiTester $I)
    {
        $I->sendPost('/auth');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); //200
        $I->seeResponseIsJson();
        $I->seeResponseContains("jwt");
    }
}
