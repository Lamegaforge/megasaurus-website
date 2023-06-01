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
        Game::factory(3)
            ->has(Clip::factory()->count(5))
            ->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
