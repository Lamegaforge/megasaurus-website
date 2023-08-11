<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Clip;
use App\Models\Game;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ShowGameControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_display_game_from_uuid(): void
    {
        $game = Game::factory()
            ->has(Clip::factory()->count(30))
            ->create();

        $response = $this->get('games/' . $game->uuid);

        $response
            ->assertOk()
            ->assertSee($game->name);

        $displayedGame = $response->original->offsetGet('game');

        $this->assertTrue($game->is($displayedGame));

        $popularGameClips = $response->original->offsetGet('popularGameClips');

        $this->assertCount(12, $popularGameClips);

        $gameClips = $response->original->offsetGet('gameClips');

        $this->assertInstanceOf(LengthAwarePaginator::class, $gameClips);

        $gameThumbnail = $response->original->offsetGet('gameThumbnail');

        $this->assertIsString($gameThumbnail);
    }
}