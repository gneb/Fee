<?php

namespace Gneb\Fee\Service;

use Gneb\Fee\Helpers\Fetch;

class GetExchangeRates 
{
    public static function execute()
    {
        global $ENV;
        return Fetch::get("{$ENV['EXCHANGE_RATE_API_URL']}/v1/latest?access_key={$ENV['EXCHANGE_RATE_API_KEY']}&base={$ENV['EXCHANGE_RATE_BASE_CURRENCY']}");
    }
}