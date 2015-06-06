<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

class BasicTest extends TestCase {
    /** @test */
    public function it_verifies_that_pages_load_properly()
    {
        $this->visit('/');
    }
}