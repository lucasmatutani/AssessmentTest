<?php

namespace Tests\Feature\Http\Controllers\Stores;

use Tests\TestCase;
use App\Domain\Stores\StoreRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index()
    {
        $user = User::factory()->create();
        $mock = $this->mock(StoreRepositoryInterface::class);
        $mock->shouldReceive('all')->once()->andReturn([]);

        $response = $this->actingAs($user)->getJson('/api/stores');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_store_method()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Sample Store',
            'address' => '123 Main St',
            'active' => true
        ];
        $mock = $this->mock(StoreRepositoryInterface::class);
        $mock->shouldReceive('create')->with($data)->andReturn($data);

        $response = $this->actingAs($user)->postJson('/api/stores', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson($data);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        $storeId = 1;
        $storeData = ['id' => $storeId, 'name' => 'Sample Store', 'address' => '123 Main St', 'active' => true];
        $mock = $this->mock(StoreRepositoryInterface::class);
        $mock->shouldReceive('find')->with($storeId)->andReturn($storeData);

        $response = $this->actingAs($user)->getJson("/api/stores/{$storeId}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($storeData);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        $storeId = 1;
        $data = ['name' => 'Updated Store'];
        $updatedData = ['id' => $storeId, 'name' => 'Updated Store', 'address' => '123 Main St', 'active' => true];
        $mock = $this->mock(StoreRepositoryInterface::class);
        $mock->shouldReceive('update')->with($storeId, $data)->andReturn($updatedData);

        $response = $this->actingAs($user)->putJson("/api/stores/{$storeId}", $data);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($updatedData);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        $storeId = 1;
        $mock = $this->mock(StoreRepositoryInterface::class);
        $mock->shouldReceive('delete')->with($storeId)->andReturn(true);

        $response = $this->actingAs($user)->deleteJson("/api/stores/{$storeId}");
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
