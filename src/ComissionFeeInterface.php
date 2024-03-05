<?php

declare(strict_types=1);

namespace Gneb\Fee;

interface ComissionFeeInterface
{
    public function getDepositFee(Transaction $transaction): float;

    public function getWithdrawFee(Transaction $transaction): float;
}
