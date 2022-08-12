<?php

declare(strict_types=1);

namespace Ritey\NginxLogAnalyzer\Contracts;

interface Format
{
    public function getStringRepresentation(): string;
}
