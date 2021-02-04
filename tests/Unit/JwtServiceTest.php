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

    // tests
    public function testShouldGenerateValidJWT()
    {
        $jwt = $this->service->generate('admin');
        $this->tester->assertIsString($jwt);

        $valid = $this->service->check($jwt);
        $this->tester->assertTrue($valid);
    }
}
