<?php

namespace Gneb\Fee\Service;

use Gneb\Fee\Helpers\Fetch;
use Gneb\Fee\Config;

class GetExchangeRates 
{
    public static function execute()
    {
        return Fetch::get("{Config::get('EXCHANGE_RATE_API_URL')}/v1/latest?access_key={Config::get('EXCHANGE_RATE_API_KEY')}&base={Config::get('EXCHANGE_RATE_BASE_CURRENCY')}");
    }
}