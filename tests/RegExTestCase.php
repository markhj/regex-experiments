<?php

namespace Markhj\RegexExperiments;

use PHPUnit\Framework\TestCase;

abstract class RegExTestCase extends TestCase
{
    protected function assertMatch(
        string $regex,
        string $subject
    ): void
    {
        $this->assertEquals(1, preg_match($regex, $subject));
    }

    protected function assertNotMatch(
        string $regex,
        string $subject
    ): void
    {
        $this->assertEquals(0, preg_match($regex, $subject));
    }
}

