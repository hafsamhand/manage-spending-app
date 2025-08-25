<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    // The RefreshDatabase trait will ensure the migrations run for tests.

    /**
     * The output buffering level at the start of each test.
     * We'll restore buffers to this level in tearDown to avoid
     * interfering with PHPUnit's own buffers.
     *
     * @var int
     */
    protected int $initialObLevel = 0;

    protected function setUp(): void
    {
        parent::setUp();

        // Record the current output buffer level at test start
        $this->initialObLevel = ob_get_level();
    }

    /**
     * Restore output buffer level to what it was at test start.
     */
    protected function tearDown(): void
    {
        // Close any buffers opened during the test, but not PHPUnit's
        while (ob_get_level() > $this->initialObLevel) {
            @ob_end_clean();
        }

        parent::tearDown();
    }
}
