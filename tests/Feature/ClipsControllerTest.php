<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Game;
use App\Models\Clip;
use Illuminate\Pagination\LengthAwarePaginator;

class ClipsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_display_clips_page(): void
    {
        Game::factory()
            ->has(Clip::factory()->count(30))
            ->create();

        $response = $this->get('clips');

        $response->assertOk();

        $clips = $response->viewData('clips');

        $this->assertInstanceOf(LengthAwarePaginator::class, $clips);
        $this->assertCount(12, $clips);
    }
}
