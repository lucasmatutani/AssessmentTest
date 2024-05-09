<?php

namespace App\Infrastructure\Books;

use App\Domain\Books\BookRepositoryInterface;
use App\Domain\Books\Book;

class BookRepository implements BookRepositoryInterface
{
    public function all()
    {
        return Book::all();
    }

    public function find($id)
    {
        return Book::find($id);
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update($id, array $data)
    {
        $book = Book::find($id);
        $book->update($data);
        return $book;
    }

    public function delete($id)
    {
        $book = Book::find($id);
        return $book->delete();
    }
}
