<?php

namespace Gneb\Fee\Helpers;
use Gneb\Fee\Transaction;

class Money 
{
    public static function getEur(Transaction $transaction)
    {
        $amount = $transaction->getAmount();

        if($transaction->getCurrency() === 'JPY'){
            $amount = $amount / 129.53;
        }
        if($transaction->getCurrency() === 'USD'){
            $amount = $amount / 1.1497;
        }

        return $amount;
    }

    public static function feeRound(float $number): float
    {
        return ceil($number * 100) / 100;
    }

    public static function format($number)
    {
        return number_format((float)$number, 2, '.', '');
    }
}