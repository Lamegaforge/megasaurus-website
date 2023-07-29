<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clip;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ClipSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $thumbnails = config('seeders.thumbnails');

        Clip::disableSearchSyncing();

        Clip::factory()
            ->count(100)
            ->state(new Sequence(
                ... array_map(fn ($thumbnail) => ['uuid' => $thumbnail], $thumbnails)
            ))
            ->create();
    }
}
