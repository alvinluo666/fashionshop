<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id'=>$this->faker->numberBetween($min=1,$max=201),
            'user_id'=>1,
            'message'=>$this->faker->paragraph,
            'rating'=>$this->faker->randomElement($array=array(1,2,3,4,5))
        ];
    }
}
