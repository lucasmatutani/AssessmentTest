<?php

namespace App\Domain\Books;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Stores\Store;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'isbn', 'value'];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'book_store');
    }
}
