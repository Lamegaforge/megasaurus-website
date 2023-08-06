<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\Clip;
use App\Repositories\FeaturedClipRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeaturedClipRepositoryTest extends TestCase 
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_fetch_clip(): void
    {
        $clip = Clip::factory()->create();

        $featuredClip = app(FeaturedClipRepository::class)->handle();

        $this->assertTrue($clip->is($featuredClip));
    }
}