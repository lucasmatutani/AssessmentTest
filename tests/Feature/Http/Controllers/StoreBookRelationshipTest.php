<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\Stores\Store;
use App\Domain\Books\Book;

class StoreBookRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_can_have_many_books()
    {
        $store = Store::factory()->create();
        $books = Book::factory()->count(3)->create();

        $store->books()->attach($books->pluck('id'));

        $this->assertCount(3, $store->books);
    }

    public function test_book_can_belong_to_many_stores()
    {
        $book = Book::factory()->create();
        $stores = Store::factory()->count(3)->create();

        $book->stores()->attach($stores->pluck('id'));

        $this->assertCount(3, $book->stores);
    }
}
