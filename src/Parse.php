<?php

declare(strict_types=1);

namespace Ritey\NginxLogAnalyzer;

use function array_combine;
use function array_shift;
use function count;
use function preg_match;

use Ritey\NginxLogAnalyzer\Contracts\Format;
use Ritey\NginxLogAnalyzer\Contracts\Parsable;
use Ritey\NginxLogAnalyzer\Contracts\Pattern;
use Ritey\NginxLogAnalyzer\Exceptions\Line;

use function trim;

final class Parse implements Parsable
{
    /** @var Format */
    private $format;

    /** @var Pattern */
    private $pattern;

    public function __construct(Format $format, Pattern $pattern)
    {
        $this->format = $format;
        $this->pattern = $pattern;
    }

    public function line(string $line): object
    {
        if ('' === trim($line)) {
            throw Line::isEmpty();
        }

        preg_match($this->pattern->build($this->format), $line, $values);
        array_shift($values);

        $identifiers = $this->pattern->getIdentifiers();

        if (count($identifiers) !== count($values)) {
            throw Line::doesNotMatchRegex($line, $this->pattern->build($this->format));
        }

        return (object) array_combine($identifiers, $values);
    }
}
