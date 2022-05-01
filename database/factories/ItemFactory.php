<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Item::class;

    public function definition()
    {
        $images = $this->faker->image('public/storage/images',640,480, null, false);
        return [
            "name"=> $this->faker->name,
            "category_id"=>$this->faker->numberBetween(1,4),
            "image"=> "http://localhost:8001/storage/images/$images",
            "user_id"=>1,
            "star"=>$this->faker->randomDigit,
            "price"=>$this->faker->numberBetween(100,400000)
        ];
    }
}
