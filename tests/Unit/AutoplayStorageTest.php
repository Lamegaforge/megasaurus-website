<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Storages\AutoplayStorage;
use Illuminate\Contracts\Session\Session;

class AutoplayStorageTest extends TestCase
{
    /**
     * @test
     */
    public function it_able_to_retrieve_autoplay_value(): void
    {
        $autoplay = app(AutoplayStorage::class)->get();

        $this->assertFalse($autoplay);
    }

    /**
     * @test
     */
    public function it_able_to_set_autoplay_value(): void
    {
        app(AutoplayStorage::class)->set(true);

        $autoplay = app(Session::class)->get('autoplay-session');

        $this->assertTrue($autoplay);
    }
}
