<?php

namespace Markhj\RegexExperiments\LookTypes;

use Markhj\RegexExperiments\RegExTestCase;
use PHPUnit\Framework\Attributes\Test;

class LookaheadLookbackTest extends RegExTestCase
{
    /**
     * Positive Lookahead
     *
     * This expression, (?=pattern), returns a match, when and only when
     * the part following the subject is a match
     *
     * @return void
     */
    #[Test]
    public function positiveLookahead(): void
    {
        $this->assertMatch('/foo(?=bar)/', 'foobar');
        $this->assertNotMatch('/foo(?=not)/', 'foobar');
    }

    /**
     * Negative Lookahead
     *
     * The opposite of "positive lookahead", where there's a match when
     * the succeeding subject isn't a match
     *
     * @return void
     */
    #[Test]
    public function negativeLookahead(): void
    {
        $this->assertNotMatch('/foo(?!bar)/', 'foobar');
        $this->assertMatch('/foo(?!not)/', 'foobar');
    }

    /**
     * Positive lookbehind
     *
     * Similar to lookahead, but it's the preceding part which must
     * match rather than the succeeding.
     *
     * @return void
     */
    #[Test]
    public function positiveLookbehind(): void
    {
        $this->assertMatch('/(?<=foo)bar/', 'foobar');
        $this->assertNotMatch('/(?<=foo)bar/', 'notbar');
    }

    /**
     * Negative lookbehind
     *
     * Opposite of "positive lookbehind", where it's a match when the preceding
     * part doesn't correspond to the pattern in the parenthesis
     *
     * @return void
     */
    #[Test]
    public function negativeLookbehind(): void
    {
        $this->assertMatch('/(?<!foo)bar/', 'notbar');
        $this->assertNotMatch('/(?<!foo)bar/', 'foobar');
    }

    /**
     * Lookahead and lookbehind are very useful in cases where
     * find/replace is needed
     *
     * The idea here is to replace "June" to with "July", but only
     * as long as the pattern is a date.
     *
     * @return void
     */
    #[Test]
    public function advancedExample(): void
    {
        // Notice in these that *only* the "06" of the date
        // is expected to be replaced
        $subject = 'Event on 2024-06-16 at building 06.';
        $expected = 'Event on 2024-07-16 at building 06.';

        // We keep the pattern specific to the date for simplicity's sake.
        // The purpose isn't to show how to look for date formats, but to
        // demonstrate a practical example of lookahead and lookback in
        // the context of find/replace
        $regex = '/(?<=2024-)(06)(?=-16)/';

        $result = preg_replace($regex, '07', $subject);

        $this->assertEquals($expected, $result);
    }
}
