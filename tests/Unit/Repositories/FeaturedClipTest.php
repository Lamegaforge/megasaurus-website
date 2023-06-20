<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Domain\Models\Clip;
use App\Repositories\FeaturedClip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Domain\Enums\ClipStateEnum;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FeaturedClipTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_fetch_clip(): void
    {
        $clip = Clip::factory()->create();

        $featuredClip = app(FeaturedClip::class)->handle();

        $this->assertSame($clip->uuid, $featuredClip->uuid);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_no_clip_above_a_view_limit(): void
    {
        Clip::factory()
            ->create([
                'views' => 29,
            ]);

        $this->expectException(NotFoundHttpException::class);

        app(FeaturedClip::class)->handle();
    }

    /**
     * @test
     * @dataProvider unexpectedStatesProvider
     */
    public function it_throws_an_exception_if_no_clip_has_the_expected_state(
        ClipStateEnum $state,
    ): void
    {
        Clip::factory()
            ->create([
                'state' => $state,
            ]);

        $this->expectException(NotFoundHttpException::class);

        app(FeaturedClip::class)->handle();
    }

    public static function unexpectedStatesProvider(): array
    {
        return [
            [ClipStateEnum::Disable],
            [ClipStateEnum::Suspicious],
        ];
    }
}