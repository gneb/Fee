<?php

namespace Gneb\Fee\Service;

use Gneb\Fee\Helpers\Fetch;

class GetExchangeRates 
{
    public static function execute()
    {
        global $ENV;
        return Fetch::get("{$ENV['EXCHANGE_RATE_API_URL']}?apikey={$ENV['EXCHANGE_RATE_API_KEY']}");
    }
}