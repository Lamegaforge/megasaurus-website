<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\Clip;
use App\Models\Game;
use App\Repositories\PaginateClipsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Options\PaginationOption;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginateClipsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returned_a_paginator(): void
    {
        Clip::factory()->create();

        $paginator = app(PaginateClipsRepository::class)->handle(
            PaginationOption::from(),
        );

        $this->assertInstanceOf(LengthAwarePaginator::class, $paginator);
    }

    /**
     * @test
     */
    public function it_is_able_to_find_clips_of_specific_game(): void
    {
        $targetedGame = Game::factory()
            ->has(Clip::factory()->count(2))
            ->create();

        Game::factory()
            ->has(Clip::factory()->count(3))
            ->create();

        $paginator = app(PaginateClipsRepository::class)->handle(
            PaginationOption::from([
                'game_uuid' => $targetedGame->uuid, 
            ]),
        );

        $paginatedClips = $paginator->items();

        $this->assertCount(2, $paginatedClips);

        $paginatedGame = $paginatedClips[0]->game;

        $this->assertTrue($paginatedGame->is($targetedGame));
    }
}
