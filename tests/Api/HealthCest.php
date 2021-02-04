<?php

class HealthCest
{
    public function tryToSendPost(ApiTester $I)
    {
        $I->sendPost('/health');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::METHOD_NOT_ALLOWED); //405
    }

    public function tryToSendGet(ApiTester $I)
    {
        $I->sendGet('/health');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); //200
    }
}
