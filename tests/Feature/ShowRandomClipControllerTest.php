<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Clip;

class ShowRandomClipControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_display_random_clip(): void
    {
        $clip = Clip::factory()->create();

        $response = $this->followingRedirects()->get('clips/random');

        $response
            ->assertOk()
            ->assertSee($clip->title);
    }
}
