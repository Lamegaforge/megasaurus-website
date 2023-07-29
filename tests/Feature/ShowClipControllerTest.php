<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Clip;

class ShowClipControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_display_clip_from_uuid(): void
    {
        $clip = Clip::factory()->create();

        Clip::factory()->for($clip->game)->count(5)->create();

        $response = $this->get('clips/' . $clip->uuid);

        $response
            ->assertOk()
            ->assertSee($clip->title)
            ->assertSee($clip->game->name);

        $randomGameClips = $response->original->offsetGet('randomGameClips');

        $this->assertCount(6, $randomGameClips);
    }
}
