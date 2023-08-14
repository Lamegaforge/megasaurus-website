<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Clip;
use App\Models\Game;

class ShowClipControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_display_clip_from_uuid(): void
    {
        $game = Game::factory()
            ->withClips(20)
            ->create();

        $clip = $game->clips()->first();

        $response = $this->get('clips/' . $clip->uuid);

        $response
            ->assertOk()
            ->assertSee($clip->title)
            ->assertSee($game->name);

        $randomClips = $response->original->offsetGet('randomClips');

        $this->assertCount(12, $randomClips);
    }
}
