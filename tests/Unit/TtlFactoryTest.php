<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\TtlFactory;

class TtlFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider payloadProvider
     */
    public function it_able_to_calculate_ttl(string $method, int $payload, int $expectedTtl): void
    {
        $ttl = TtlFactory::{$method}($payload);

        $this->assertSame($expectedTtl, $ttl);
    }

    public static function payloadProvider(): array
    {
        return [
            ['minutes', 1, 60],
            ['minutes', 2, 120],
            ['hours', 1, 3600],
            ['hours', 2, 7200],
            ['days', 1, 86400],
            ['days', 2, 172800],
        ];
    }
}
