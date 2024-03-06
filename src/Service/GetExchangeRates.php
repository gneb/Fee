<?php

declare(strict_types=1);

namespace Gneb\Fee\Service;

use Gneb\Fee\Config;
use Gneb\Fee\Helpers\Fetch;

class GetExchangeRates
{
    public static function execute()
    {
        $url = sprintf('%s/v1/latest?access_key=%s&base=%s',
            Config::get('EXCHANGE_RATE_API_URL'),
            Config::get('EXCHANGE_RATE_API_KEY'),
            Config::get('EXCHANGE_RATE_BASE_CURRENCY')
        );

        return Fetch::get($url);
    }
}
