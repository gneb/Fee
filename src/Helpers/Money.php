<?php

namespace Gneb\Fee\Helpers;
use Gneb\Fee\Transaction;

class Money 
{
    public static function getEur(Transaction $transaction): float
    {
        $amount = $transaction->getAmount() / Transaction::getExchangeRateOf($transaction->getCurrency());

        return $amount;
    }

    public static function feeRound(float $number): float
    {
        return ceil($number * 100) / 100;
    }

    public static function format($number): string
    {
        return number_format((float)$number, 2, '.', '');
    }
}