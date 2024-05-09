<?php

namespace Database\Factories\Domain\Books;

use App\Domain\Books\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->numerify('##########'),
            'value' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
