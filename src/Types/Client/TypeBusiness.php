<?php

namespace Gneb\Fee\Types\Client;

use Gneb\Fee\ComissionFeeInterface;
use Gneb\Fee\Transaction;
use Gneb\Fee\Helpers\Money;

class TypeBusiness implements ComissionFeeInterface
{
    public function getDepositFee(Transaction $transaction): float
    {
        return Money::feeRound($transaction->getAmount() * 0.03 / 100);
    }

    public function getWithdrawFee(Transaction $transaction): float
    {
        return Money::feeRound($transaction->getAmount() * 0.5 / 100);

    }
}
