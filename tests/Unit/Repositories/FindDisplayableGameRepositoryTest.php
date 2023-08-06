<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Dtos\Uuid;
use App\Models\Game;
use App\Models\Clip;
use App\Repositories\FindDisplayableGameRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Domain\Enums\ClipStateEnum;

class FindDisplayableGameRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_find_game(): void
    {
        $game = Game::factory()
            ->withClips(9)
            ->create();

        $displayableGame = app(FindDisplayableGameRepository::class)->handle(
            uuid: Uuid::fromGame($game),
        );

        $this->assertTrue($game->is($displayableGame));
        $this->assertEquals(9, $displayableGame->clips_count);
    }

    /**
     * @test
     */
    public function an_unknown_uuid_will_throw_an_exception(): void
    {
        $this->expectException(ModelNotFoundException::class);

        app(FindDisplayableGameRepository::class)->handle(
            uuid: Uuid::fromString('unknown'),
        );
    }

    /**
     * @test
     */
    public function game_must_have_available_clips_to_be_found(): void
    {
        $clip = Clip::factory()
            ->withState(ClipStateEnum::Suspicious)
            ->create();

        $this->expectException(ModelNotFoundException::class);

        app(FindDisplayableGameRepository::class)->handle(
            uuid: Uuid::fromGame($clip->game),
        );
    }
}
