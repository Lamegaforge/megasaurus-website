<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Sequence;

class GameSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Game::disableSearchSyncing();

        $cards = config('seeders.cards');

        Game::factory()
            ->count(40)
            ->state(new Sequence(
                ... array_map(fn ($card) => ['uuid' => $card], $cards)
            ))
            ->create();
    }
}
