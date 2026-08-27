<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // public/build is a build artefact and is not committed, so the test
        // suite renders views without resolving the Vite manifest.
        $this->withoutVite();
    }
}
