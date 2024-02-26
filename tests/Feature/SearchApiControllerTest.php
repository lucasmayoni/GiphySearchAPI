<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchApiControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public User $user;
    public string $gifDemoId = "3PAGDqG9ENQF8QHZKt";
    protected function setUp():void
    {
        parent::setUp();
        $this->artisan('passport:install');
        $this->user = User::factory()->create();
    }
    protected function headers($user = null): array
    {
        $headers = ['Accept' => 'application/json'];

        if (!is_null($user)) {
            $token = $user->createToken('MyApp')->accessToken;
            $headers['Authorization'] = 'Bearer ' . $token;
        }
        return $headers;
    }
    public function testSearchReturnsOk(): void
    {
        $response = $this->get('/api/search?text=test',$this->headers($this->user));
        $response->assertStatus(200)
                ->assertJsonStructure([
                   'data' => 'data',
                ]);
    }
    public function testSearchNotFound(): void
    {

        $response = $this->get('/api/pacoca?text=test',$this->headers($this->user));
        $response->assertStatus(404);
    }

    public function testSearchWithSeveralResults(): void {

        $response = $this->get('/api/search?text=mickey&limit=10&offset=10',$this->headers($this->user));
        $response->assertStatus(200);
        $content = json_decode($response->getContent());
        $this->assertEquals(10, $content->pagination->count);
    }

    public function testGetById():void
    {
        $response = $this->get('/api/search/'.$this->gifDemoId,$this->headers($this->user));
        $response->assertStatus(200);
        $content = json_decode($response->getContent());
        $this->assertEquals("gif", $content->data->type);
    }
    public function testGetByIdNotFound()
    {
        $response = $this->get('/api/search/FAKEID',$this->headers($this->user));
        $response->assertStatus(404);
    }

    public function testAddFavorite():void {
        $data = [
            'id' => $this->gifDemoId,
            'alias' => $this->faker->slug
        ];
        $response = $this->post('/api/fav',$data,$this->headers($this->user));
        $response->assertStatus(201);
    }

    public function testAddFavoriteFails(): void
    {
        $data = [
            'id' => $this->gifDemoId
        ];
        $response = $this->post('/api/fav',$data,$this->headers($this->user));
        $response->assertStatus(403);
    }
}
