<?php

namespace Database\Factories;

use App\Models\User;
use Faker\Provider\ar_EG\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blogs>
 */
class BlogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



    public function definition(): array
    {
        $users= User::pluck('id')->toArray();
        return [
            'title'=>fake()->text(10),
            'description'=>fake()->text(),
            'user_id'=>fake()->randomElement($users)

        ];
    }
}
