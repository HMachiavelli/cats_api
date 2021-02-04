<?php

use App\Services\JwtService;

class BreedsCest
{
    public function _before(ApiTester $I)
    {
        $this->token = (new JwtService())->generate();
    }

    // tests
    public function tryToSendPost(ApiTester $I)
    {
        $I->sendPost('/breeds');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::METHOD_NOT_ALLOWED); //405
    }

    public function tryToSearchWithoutToken(ApiTester $I)
    {
        $I->sendGet('/breeds?name=Bobtail');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::UNAUTHORIZED); //401
    }

    public function tryToSearchWithInvalidToken(ApiTester $I)
    {
        $I->haveHttpHeader('Authorization', 'Bearer a' . $this->token);
        $I->sendGet('/breeds?name=Bobtail');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::UNAUTHORIZED); //401
    }

    public function tryToSearchWithTokenAndValidName(ApiTester $I)
    {
        $I->haveHttpHeader('Authorization', 'Bearer ' . $this->token);
        $I->sendGet('/breeds?name=Bobtail');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); //200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            "name" => "American Bobtail"
        ]);
    }
}
