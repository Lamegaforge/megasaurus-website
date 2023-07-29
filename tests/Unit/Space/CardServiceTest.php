<?php

namespace Tests\Unit\Space;

use Tests\TestCase;
use App\Models\Game;
use App\Services\Space\CardService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_make_card(): void
    {
        $game = Game::factory()->create();

        $cardService = new CardService(
            'cdn_path_base',
            'testing',
        );

        $card = $cardService->get($game);

        $this->assertSame('cdn_path_base/testing/cards/' . $game->uuid, $card);
    }
}
