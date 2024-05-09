<?php

namespace Database\Factories\Domain\Stores;

use App\Domain\Stores\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'active' => $this->faker->boolean,
        ];
    }
}
