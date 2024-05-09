<?php

namespace App\Domain\Stores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Books\Book;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'active'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_store');
    }
}
