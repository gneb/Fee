<?php

namespace Gneb\Fee\Types\Client;

use Gneb\Fee\ComissionFeeInterface;
use Gneb\Fee\Transaction;
use Gneb\Fee\Helpers\GDate;
use Gneb\Fee\Helpers\Money;

class TypePrivate implements ComissionFeeInterface
{
    public function getDepositFee(Transaction $transaction): float
    {
        return Money::feeRound($transaction->getAmount() * 0.03 / 100);
    }

    public function getWithdrawFee(Transaction $transaction): float
    {
        // get monday of transaction week
        $monday = strtotime('last monday', strtotime($transaction->getDate()));
        // all client transactions
        $allTransactions = $transaction->getClient()->getTransactions();

        // get previous transactions for the week
        $weekTransactions = array_filter($allTransactions, function($itemTransaction) use($transaction, $monday){
            return $itemTransaction->getType() === 'withdraw'
                    && $itemTransaction->getDate() >= date('Y-m-d', $monday)
                    && $itemTransaction->getId() < $transaction->getId();
        });
        
        // sum of previous transactions of week in eur
        $sumOfWeekTransactions = array_reduce($weekTransactions, function($sum, $item){
            return $sum += Money::getEur($item);
        });

        $current = $transaction->getAmount();

        $t = 1000;
        if($transaction->getCurrency() === 'JPY'){
            $t = $t * 129.53;
        }
        if($transaction->getCurrency() === 'USD'){
            $t = $t * 1.1497;
        }
        if(count($weekTransactions) < 3 && $t >= $sumOfWeekTransactions){
            $current = $current - ($t - $sumOfWeekTransactions);
            $current = $current < 0 ? 0 : $current;
        }
        return Money::feeRound($current * 0.3 / 100);
    }
}