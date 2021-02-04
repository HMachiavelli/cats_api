<?php

use App\Services\JwtService;

class JwtServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->service = new JwtService();
    }

    protected function _after()
    {
    }

    // tests
    public function testShouldGenerateValidJWT()
    {
        $jwt = $this->service->generate();
        $this->tester->assertIsString($jwt);

        $valid = $this->service->check($jwt);
        $this->tester->assertTrue($valid);
    }
}
