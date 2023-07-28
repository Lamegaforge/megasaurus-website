<?php

namespace Tests\Unit;

use Mockery;
use App\Models\Clip;
use Mockery\MockInterface;
use App\Services\IframeService;
use Tests\TestCase;
use App\Storages\AutoplayStorage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IframeServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_generate_iframe_src(): void
    {
        $iframeService = $this->instantiateIframeService();

        $clip = Clip::factory()->create();

        $src = $iframeService->getSrc($clip);

        $this->assertEquals(
            'https://base-url.fr/embed?clip=' . $clip->external_id . '&parent=parent_1&parent=parent_2&autoplay=true',
            $src,
        );
    }

    private function instantiateIframeService(): IframeService
    {
        $autoplayStorage = $this->mockAutoplayStorage(function (MockInterface $mock) {
            $mock->shouldReceive('get')->andReturn(true);
        });

        return new IframeService(
            'https://base-url.fr/',
            [
                'parent_1',
                'parent_2',
            ],
            $autoplayStorage,
        );
    }

    private function mockAutoplayStorage(\closure $closure): AutoplayStorage
    {
        return Mockery::mock(AutoplayStorage::class, $closure);
    }
}
