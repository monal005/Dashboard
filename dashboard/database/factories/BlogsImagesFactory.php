<?php

namespace Database\Factories;

use App\Models\Blogs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogsImages>
 */
class BlogsImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = Blogs::pluck('id')->toArray();
        return [
            'blogs_id'=>fake()->randomElement($users)
        ];
    }
}
