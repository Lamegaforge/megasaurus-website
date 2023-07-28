<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Domain\Models\Game;
use Domain\Models\Clip;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_display_homepage(): void
    {
        $game = Game::factory()
            ->has(Clip::factory()->count(5))
            ->create();

        $response = $this->get('/');

        $clips = $game->clips;

        $response
            ->assertOk()
            ->assertSee($clips->first()->title)
            ->assertSee($clips->last()->title)
            ->assertSee($game->uuid);
    }
}
