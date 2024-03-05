<?php

namespace Gneb\Fee\Types\Client;

use Gneb\Fee\ComissionFeeInterface;
use Gneb\Fee\Transaction;
use Gneb\Fee\Helpers\Money;

class TypeBusiness implements ComissionFeeInterface
{
    public function getDepositFee(Transaction $transaction): float
    {
        global $ENV;
        return Money::feeRound($transaction->getAmount() * $ENV['PERCENT_BUSINESS_DEPOSIT_FEE'] / 100);
    }

    public function getWithdrawFee(Transaction $transaction): float
    {
        global $ENV;
        return Money::feeRound($transaction->getAmount() * $ENV['PERCENT_BUSINESS_WITHDRAW_FEE'] / 100);

    }
}
