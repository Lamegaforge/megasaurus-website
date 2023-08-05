<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Game;
use App\Models\Clip;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\Sequence;

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

    /**
     * @test
     */
    public function it_able_to_sort_by_views(): void
    {
        Game::factory()
            ->has(Clip::factory()->count(30))
            ->create();

        $response = $this->get('clips?sort=views');

        $response->assertOk();

        $clips = $response->viewData('clips');

        $views = $clips->pluck('views');

        $views->zip($views->skip(1))
            ->each(function ($pair) {
                $this->assertGreaterThanOrEqual($pair[1], $pair[0]);
            });
    }

    /**
     * @test
     */
    public function it_able_to_sort_by_published_at(): void
    {
        Clip::factory()
            ->state(new Sequence(
                ['published_at' => '2023-02-01'],
                ['published_at' => '2023-03-01'],
                ['published_at' => '2023-01-01'],
            ))
            ->count(3)
            ->create();

        $response = $this->get('clips?sort=published_at');

        $response->assertOk();

        $clips = $response->viewData('clips');

        $firstPaginatedClip = $clips->first();
        $lastPaginatedClip = $clips->last();

        $this->assertTrue(
            $firstPaginatedClip->published_at->gt($lastPaginatedClip->published_at),
        );
    }
}
