<?php

use App\Models\User;

class UserModelTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->user = new User();
    }

    // tests
    public function testShouldReturnUserWhenExists()
    {
        $result = $this->user->getByUsername('admin');

        $this->tester->assertIsArray($result);
        $this->tester->assertArrayHasKey('id', $result);
        $this->tester->assertArrayHasKey('username', $result);
        $this->tester->assertArrayHasKey('password', $result);
        $this->tester->assertArrayHasKey('createdAt', $result);
    }

    public function testShouldReturnFalseWhenUserDoesNotExist()
    {
        $result = $this->user->getByUsername('usuarioquenaoexiste');

        $this->tester->assertFalse($result);
    }
}
