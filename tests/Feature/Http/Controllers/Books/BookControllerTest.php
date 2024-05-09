<?php

namespace Tests\Feature\Http\Controllers\Books;

use Tests\TestCase;
use App\Domain\Books\BookRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index()
    {
        $user = User::factory()->create();
        $mock = $this->mock(BookRepositoryInterface::class);
        $mock->shouldReceive('all')->once()->andReturn([]);

        $response = $this->actingAs($user)->getJson('/api/books');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Sample Book',
            'isbn' => '1234567890123',
            'value' => 15.99,
        ];
        $mock = $this->mock(BookRepositoryInterface::class);
        $mock->shouldReceive('create')->with($data)->andReturn($data);

        $response = $this->actingAs($user)->postJson('/api/books', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson($data);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        $bookId = 1;
        $bookData = ['id' => $bookId, 'name' => 'Sample Book', 'isbn' => '1234567890123', 'value' => 15.99];
        $mock = $this->mock(BookRepositoryInterface::class);
        $mock->shouldReceive('find')->with($bookId)->andReturn($bookData);

        $response = $this->actingAs($user)->getJson("/api/books/{$bookId}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($bookData);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        $bookId = 1;
        $data = ['name' => 'Updated Book'];
        $updatedData = ['id' => $bookId, 'name' => 'Updated Book', 'isbn' => '1234567890123', 'value' => 15.99];
        $mock = $this->mock(BookRepositoryInterface::class);
        $mock->shouldReceive('update')->with($bookId, $data)->andReturn($updatedData);

        $response = $this->actingAs($user)->putJson("/api/books/{$bookId}", $data);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($updatedData);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        $bookId = 1;
        $mock = $this->mock(BookRepositoryInterface::class);
        $mock->shouldReceive('delete')->with($bookId)->andReturn(true);

        $response = $this->actingAs($user)->deleteJson("/api/books/{$bookId}");
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
