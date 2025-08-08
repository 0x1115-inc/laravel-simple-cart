<?php
/**
 * Copyright 2025 0x1115 Inc <info@0x1115.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace MCXV\SimpleCart\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MCXV\SimpleCart\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\MCXV\SimpleCart\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 1000), // Random price between 1 and 1000
            'stock_quantity' => $this->faker->numberBetween(0, 100), // Random stock quantity
            'is_active' => $this->faker->boolean(), // Randomly active or inactive
            'image_url' => $this->faker->imageUrl(640, 480, 'product'), // Random image URL
            'category' => $this->faker->word(), // Random category name
        ];
    }
}
