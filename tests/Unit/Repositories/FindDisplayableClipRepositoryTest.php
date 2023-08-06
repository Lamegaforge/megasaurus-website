<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Dtos\Uuid;
use App\Models\Game;
use App\Models\Clip;
use App\Repositories\FindDisplayableClipRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Domain\Enums\ClipStateEnum;

class FindDisplayableClipRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_find_clip(): void
    {
        $clip = Clip::factory()->create();

        $displayableClip = app(FindDisplayableClipRepository::class)->handle(
            uuid: Uuid::fromClip($clip),
        );

        $this->assertTrue($clip->is($displayableClip));

        $this->assertTrue($displayableClip->relationLoaded('game'));
        $this->assertTrue($displayableClip->relationLoaded('author'));
    }

    /**
     * @test
     */
    public function an_unknown_uuid_will_throw_an_exception(): void
    {
        $this->expectException(ModelNotFoundException::class);

        app(FindDisplayableClipRepository::class)->handle(
            uuid: Uuid::fromString('unknown'),
        );
    }

    /**
     * @test
     * @dataProvider unavailableClipsStatesProvider
     */
    public function unexpected_state_will_make_the_clip_unavailable(ClipStateEnum $state): void
    {
        $clip = Clip::factory()
            ->withState($state)
            ->create();

        $this->expectException(ModelNotFoundException::class);

        app(FindDisplayableClipRepository::class)->handle(
            uuid: Uuid::fromClip($clip),
        );
    }

    public static function unavailableClipsStatesProvider(): array
    {
        return [
            [ClipStateEnum::Suspicious],
            [ClipStateEnum::Disable],
        ];
    }
}
