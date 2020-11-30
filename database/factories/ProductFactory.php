<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'price'=>$this->faker->randomFloat($nbMaxDecimals=NULL, $min = 1000, $max =100000),
            'promotePrice'=>Null,
            'category'=>$this->faker->randomElement($array=array(1,2,3)),
            'type'=>$this->faker->randomElement($array=array(1,2,4,5,6,7,8,9,10)),
            'color'=>['red','green','blue'],
            'size'=>['S','M','L','XL'],
            'image'=>array($this->faker->imageUrl($width = 640, $height = 480),$this->faker->imageUrl($width = 640, $height = 480),$this->faker->imageUrl($width = 640, $height = 480)),
            'description'=>$this->faker->text($maxNbChars = 200),
            'created_at'=>now(),
            'updated_at'=>Null
        ];
    }
}
