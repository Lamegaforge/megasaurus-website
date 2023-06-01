<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\ValueObjects\Game;
use App\ValueObjects\Clip;
use App\Services\CdnService;

class CdnServiceTest extends TestCase
{
    /**
     * @test
     */
    public function it_able_to_make_thumbnail(): void
    {
        $clip = Clip::from([
            'id' => '123456',
            'external_id' => '789456',
            'title' => 'clip title',
        ]);

        $cdnService = new CdnService('cdn_path_base');

        $thumbnail = $cdnService->thumbnail($clip);

        $this->assertSame('cdn_path_base/thumbnails/789456', $thumbnail);
    }

    /**
     * @test
     */
    public function it_able_to_make_card(): void
    {
        $game = Game::from([
            'id' => '123456',
            'external_id' => '789456',
            'name' => 'game name',
        ]);

        $cdnService = new CdnService('cdn_path_base');

        $card = $cdnService->card($game);

        $this->assertEquals('cdn_path_base/cards/789456', $card);
    }
}
