<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $images = $this->faker->image('public/storage/images',640,480, null, false);
        return [
            "name"=> $this->faker->name,
            "image"=> "http://localhost:8001/storage/images/$images"
        ];
    }
}
