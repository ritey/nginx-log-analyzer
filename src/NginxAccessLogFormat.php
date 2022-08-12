<?php

declare(strict_types=1);

namespace Ritey\NginxLogAnalyzer;

use Ritey\NginxLogAnalyzer\Contracts\Format;

final class NginxAccessLogFormat implements Format
{
    public function getStringRepresentation(): string
    {
        return '$remote_addr - $remote_user [$time_local] "$request" $status $bytes_sent "$http_referer" "$http_user_agent"';
    }
}
