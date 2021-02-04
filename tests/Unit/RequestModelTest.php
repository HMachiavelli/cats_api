<?php

use App\Models\Request;

class RequestModelTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->request = new Request([
            'name' => 'Teste',
            'response' => '[]'
        ]);
    }

    // tests
    public function testShouldInsertAndGetByNameWhenExists()
    {
        $id = $this->request->insert();

        $this->tester->assertIsInt($id);

        $result = $this->request->getByName('Teste');

        $this->tester->assertIsArray($result);
        $this->tester->assertArrayHasKey('name', $result);
        $this->tester->assertArrayHasKey('response', $result);
        $this->tester->assertEquals($this->request->getName(), $result['name']);
        $this->tester->assertEquals($this->request->getResponse(), $result['response']);
    }

    public function testShouldReturnFalseWhenNameDoesNotExist()
    {
        $result = $this->request->getByName('NomeQueNaoExiste');

        $this->tester->assertFalse($result);
    }
}
