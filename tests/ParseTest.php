<?php

declare(strict_types=1);

namespace Ritey\NginxLogAnalyzer\Tests;

use PHPUnit\Framework\TestCase;
use Ritey\NginxLogAnalyzer\Contracts\Format;
use Ritey\NginxLogAnalyzer\Exceptions\Line;
use Ritey\NginxLogAnalyzer\NginxAccessLogFormat;
use Ritey\NginxLogAnalyzer\Parse;
use Ritey\NginxLogAnalyzer\RegexPattern;
use SplFileObject;
use stdClass;

/**
 * @internal
 * @coversNothing
 */
class ParseTest extends TestCase
{
    /** @var Parse */
    private $parse;

    /** @var SplFileObject */
    private $fixture;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fixture = new SplFileObject(__DIR__.'/logs/access.log');
        $this->parse = new Parse(new NginxAccessLogFormat(), new RegexPattern());
    }

    /**
     * @test
     */
    public function canParseSingleLine(): void
    {
        $line = $this->fixture->fgets();
        $result = $this->parse->line($line);

        $this->assertInstanceOf(stdClass::class, $result);
    }

    /**
     * @test
     */
    public function throwWhenParseEmptyLine(): void
    {
        $this->expectException(Line::class);

        $this->parse->line('');
    }

    /**
     * @test
     */
    public function throwWhenLineDoesNotMatchRegex(): void
    {
        $this->expectException(Line::class);

        $parse = new Parse(new class() implements Format {
            public function getStringRepresentation(): string
            {
                return '$this $is $not $valid';
            }
        }, new RegexPattern());

        $parse->line('- -');
    }
}
