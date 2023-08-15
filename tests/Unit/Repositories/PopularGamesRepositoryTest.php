<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\Game;
use App\Models\Clip;
use App\Repositories\PopularGamesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Sequence;

class PopularGamesRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_fetch_popular_games(): void
    {
        Game::factory()
            ->create([
                'active_clip_count' => 9,
            ]);

        Game::factory()
            ->create([
                'active_clip_count' => 6,
            ]);

        Game::factory()
            ->create([
                'active_clip_count' => 3,
            ]);


        $games = app(PopularGamesRepository::class)->handle();

        $this->assertCount(3, $games);

        $orderedClipsCount = $games->pluck('active_clip_count');

        $this->assertEquals([9, 6, 3], $orderedClipsCount->toArray());
    }
}
