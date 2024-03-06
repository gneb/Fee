<?php

declare(strict_types=1);

namespace Gneb\Fee\Types\Client;

use Gneb\Fee\ComissionFeeInterface;
use Gneb\Fee\Config;
use Gneb\Fee\Helpers\Money;
use Gneb\Fee\Transaction;

class TypePrivate implements ComissionFeeInterface
{
    public function getDepositFee(Transaction $transaction): float
    {
        return Money::feeRound($transaction->getAmount() * Config::get('PERCENT_PRIVATE_DEPOSIT_FEE') / 100);
    }

    public function getWithdrawFee(Transaction $transaction): float
    {
        // get monday of transaction week
        $monday = strtotime('last monday', strtotime($transaction->getDate()));
        // all client transactions
        $allTransactions = $transaction->getClient()->getTransactions();

        // get previous transactions for the week
        $weekTransactions = array_filter($allTransactions, function ($itemTransaction) use ($transaction, $monday) {
            return $itemTransaction->getType() === 'withdraw'
                    && $itemTransaction->getDate() >= date('Y-m-d', $monday)
                    && $itemTransaction->getId() < $transaction->getId();
        });
        // sum of previous transactions of week in eur
        $sumOfWeekTransactions = array_reduce($weekTransactions, function ($sum, $item) {
            return $sum += Money::getDefaultForExchangeRate($item);
        });
        $current = $transaction->getAmount();

        $t = Config::get('FREE_LIMIT_AMOUNT');
        // free limit in transaction currency
        $t = $t * Transaction::getExchangeRateOf($transaction->getCurrency());

        if (count($weekTransactions) < Config::get('FREE_WEEKLY_TRANSACTIONS_NUMBER') && $sumOfWeekTransactions < Config::get('FREE_LIMIT_AMOUNT')) {
            $current = $current - ($t - ($sumOfWeekTransactions * Transaction::getExchangeRateOf($transaction->getCurrency())));
            $current = $current < 0 ? 0 : $current;
        }

        return Money::feeRound($current * Config::get('PERCENT_PRIVATE_WITHDRAW_FEE') / 100);
    }
}
