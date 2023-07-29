<?php

namespace Tests\Unit\Space;

use Tests\TestCase;
use App\Models\Clip;
use App\Services\Space\ThumbnailService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThumbnailServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_make_thumbnail(): void
    {
        $clip = Clip::factory()->create();

        $thumbnailService = new ThumbnailService(
            'cdn_path_base',
            'testing',
        );

        $thumbnail = $thumbnailService->get($clip);

        $this->assertSame('cdn_path_base/testing/thumbnails/' . $clip->uuid, $thumbnail);
    }
}
