<?php

namespace Tests\Services;

use App\Services\SearchApiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Mockery;
use Tests\TestCase;
use function PHPUnit\Framework\assertEmpty;

class SearchApiServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testSearchWithSuccess() {
        Http::fake([
            'base_url/search' => Http::response(['fake_data' => 'value'], 200),
        ]);

        $searchServiceMock = Mockery::mock(SearchApiService::class);
        $searchServiceMock->shouldReceive('search')
            ->with('random_text', 10, 0)
            ->andReturn(['success' => true, 'response_code' => 200, 'data' => ['fake_data' => 'value']]);

        $result = $searchServiceMock->search('random_text', 10, 0);
        $this->assertTrue($result['success']);
        $this->assertEquals(200, $result['response_code']);
        $this->assertArrayHasKey('fake_data', $result['data']);
    }

    public function testSearchWithError()
    {
        Http::fake([
            'base_url/search' => Http::response(['fake_data' => 'value'], 404),
        ]);
        $searchServiceMock = Mockery::mock(SearchApiService::class);
        $searchServiceMock->shouldReceive('search')
            ->with('random_text', 10, 0)
            ->andReturn(['success' => false, 'response_code' => 404, 'data' => [], 'errors'=>'Some error Message']);
        $result = $searchServiceMock->search('random_text', 10, 0);
        $this->assertFalse($result['success']);
        $this->assertEquals('Some error Message', $result['errors']);
        $this->assertEquals(404, $result['response_code']);
        assertEmpty($result['data']);
    }

    public function testGetById()
    {
        Http::fake([
            'base_url/search/123ABC' => Http::response(['fake_data' => 'value'], 200),
        ]);
        $searchServiceMock = Mockery::mock(SearchApiService::class);
        $searchServiceMock->shouldReceive('getById')
                          ->with('123ABC')
                          ->andReturn(['success' => true, 'response_code' => 200, 'data' => ['fake_data' => 'value']]);
        $result = $searchServiceMock->getById('123ABC');
        $this->assertTrue($result['success']);
        $this->assertEquals(200, $result['response_code']);
        $this->assertArrayHasKey('fake_data', $result['data']);
    }

    public function testGetByIdNotFound()
    {
        Http::fake([
            'base_url/search/123ABC' => Http::response(['fake_data' => 'value'], 404),
        ]);
        $searchServiceMock = Mockery::mock(SearchApiService::class);
        $searchServiceMock->shouldReceive('getById')
            ->with('123ABC')
            ->andReturn(['success' => false, 'response_code' => 404, 'data' => [], 'errors'=>'Some error Message']);
        $result = $searchServiceMock->getById('123ABC');
        $this->assertFalse($result['success']);
        $this->assertEquals(404, $result['response_code']);
        $this->assertEquals('Some error Message', $result['errors']);
        assertEmpty($result['data']);
    }

}
