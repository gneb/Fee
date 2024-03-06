<?php

declare(strict_types=1);

namespace Gneb\Fee\Types\Client;

use Gneb\Fee\ComissionFeeInterface;
use Gneb\Fee\Config;
use Gneb\Fee\Helpers\Money;
use Gneb\Fee\Transaction;

class TypeBusiness implements ComissionFeeInterface
{
    public function getDepositFee(Transaction $transaction): float
    {
        return Money::feeRound($transaction->getAmount() * Config::get('PERCENT_BUSINESS_DEPOSIT_FEE') / 100);
    }

    public function getWithdrawFee(Transaction $transaction): float
    {
        return Money::feeRound($transaction->getAmount() * Config::get('PERCENT_BUSINESS_WITHDRAW_FEE') / 100);
    }
}
