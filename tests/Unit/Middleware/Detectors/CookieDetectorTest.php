<?php

namespace CodeZero\LocalizedRoutes\Tests\Unit\Middleware\Detectors;

use CodeZero\LocalizedRoutes\Middleware\Detectors\CookieDetector;
use CodeZero\LocalizedRoutes\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;

final class CookieDetectorTest extends TestCase
{
    protected function tearDown(): void
    {
        unset($_COOKIE[$this->cookieName]);

        parent::tearDown();
    }

    #[Test]
    public function it_can_detect_a_raw_cookie_value(): void
    {
        Config::set('localized-routes.check_raw_cookie', true);
        $_COOKIE[$this->cookieName] = 'nl';

        $this->assertEquals('nl', (new CookieDetector())->detect());
    }

    #[Test]
    public function it_ignores_raw_cookie_values_by_default(): void
    {
        $_COOKIE[$this->cookieName] = 'nl';

        $this->assertNull((new CookieDetector())->detect());
    }
}
