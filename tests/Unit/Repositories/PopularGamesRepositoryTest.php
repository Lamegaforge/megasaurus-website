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
            ->withClips(9)
            ->create();

        Game::factory()
            ->withClips(6)
            ->create();

        Game::factory()
            ->withClips(3)
            ->create();


        $games = app(PopularGamesRepository::class)->handle();

        $this->assertCount(3, $games);

        $orderedClipsCount = $games->pluck('clips_count');

        $this->assertEquals([9, 6, 3], $orderedClipsCount->toArray());
    }

    /**
     * @test
     */
    public function only_available_clips_are_counted(): void
    {
        $clips = Clip::factory()
            ->state(new Sequence(
                ['state' => 1],
                ['state' => 2],
                ['state' => 3],
            ))
            ->count(10);

        Game::factory()
            ->has($clips)
            ->create();

        $games = app(PopularGamesRepository::class)->handle();

        $game = $games->first();

        $this->assertEquals(4, $game->clips_count);
    }
}
