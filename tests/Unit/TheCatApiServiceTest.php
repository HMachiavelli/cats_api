<?php

use App\Services\TheCatApiService;

class TheCatApiServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->service = new TheCatApiService();
    }

    // tests
    public function testShouldReturnArrayWhenBreedSearch()
    {
        $result = $this->service->breedSearch('Bobtail');

        $this->tester->assertIsArray($result);
        $this->tester->assertArrayHasKey('name', $result);
        $this->tester->assertArrayHasKey('response', $result);
        $this->tester->assertIsString($result['name']);
        $this->tester->assertIsString($result['response']);
    }
}
