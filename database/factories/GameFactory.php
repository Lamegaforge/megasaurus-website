<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clip;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'external_id' => fake()->randomNumber(8, true),
            'name' => fake()->name(),
            'active_clip_count' => fake()->numberBetween(3, 50),
        ];
    }

    public function withClips(int $nb): self
    {
        return $this->has(
            Clip::factory()->count($nb),
        );
    }
}
