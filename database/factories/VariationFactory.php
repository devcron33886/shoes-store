<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variation>
 */
class VariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name='Measurement';
        $type='Bunch Kg Punnet Piece';
        return [
            'product_id'=>$this->faker->unique()->numberBetween(1,206),
            'name'=>$name,
            'price'=>$this->faker->numberBetween(400,1800),
            'type'=>$type,
            'sku'=>$this->faker->numberBetween(1111,20000),
            'parent_id'=>null,
            'order'=>1,
        ];
    }
}
