<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Domain\Models\Game;
use Domain\Models\Clip;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $clips = Clip::factory()
            ->count(30)
            ->state(function () {
                return [
                    'external_id' => 'SavageMoldyKoalaKappaClaus',
                ];
            });

        Game::factory(20)
            ->has($clips)
            ->create();
    }
}
