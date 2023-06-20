<?php

namespace Tests\Unit;

use Mockery;
use App\ValueObjects\Clip;
use Mockery\MockInterface;
use App\Services\IframeService;
use Tests\TestCase;
use App\Storages\AutoplayStorage;

class IframeServiceTest extends TestCase
{
    /**
     * @test
     */
    public function it_able_to_generate_iframe_src(): void
    {
        $this->mockAutoplayStorage(function (MockInterface $mock) {
            $mock->shouldReceive('get')->andReturn(true);
        });

        $iframeService = $this->instantiateIframeService();

        $clip = Clip::from([
            'uuid' => '83728917',
            'external_id' => '196a9739b178',
            'title' => '',
        ]);

        $src = $iframeService->getSrc($clip);

        $this->assertEquals(
            'https://base-url.fr/embed?clip=196a9739b178&parent=parent_1&parent=parent_2&autoplay=true',
            $src,
        );
    }

    private function mockAutoplayStorage(\closure $closure)
    {
        $this->instance(
            AutoplayStorage::class,
            Mockery::mock(AutoplayStorage::class, $closure)
        );
    }

    private function instantiateIframeService(): IframeService
    {
        return new IframeService(
            'https://base-url.fr/',
            [
                'parent_1',
                'parent_2',
            ],
        );
    }
}
