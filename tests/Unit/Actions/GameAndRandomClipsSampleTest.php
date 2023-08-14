<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\Clip;
use App\Models\Game;
use App\Actions\GameAndRandomClipsSample;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameAndRandomClipsSampleTest extends TestCase 
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_get_a_clips_sample(): void
    {
        $game = Game::factory()
            ->withClips(8)
            ->create();

        Game::factory()
            ->withClips(8)
            ->create();

        $randomClips = app(GameAndRandomClipsSample::class)->handle($game);

        $this->assertCount(12, $randomClips);

        $filtered = $randomClips
            ->where('game_id', $game->id)
            ->filter()
            ->all();

        $this->assertTrue($filtered > 8);
    }
}