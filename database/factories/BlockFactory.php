<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\Blockchain;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Block>
 */
class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'blockchain_id' => Blockchain::factory()->create()->id,
        ];
    }
}
