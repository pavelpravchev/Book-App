<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory
    extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'code' => $this->faker->name(),
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(1),
        ];
    }
}
