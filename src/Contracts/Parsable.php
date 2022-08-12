<?php

declare(strict_types=1);

namespace Ritey\NginxLogAnalyzer\Contracts;

interface Parsable
{
    public function line(string $line): object;
}
