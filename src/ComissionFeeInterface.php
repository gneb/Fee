<?php

namespace Gneb\Fee;
use Gneb\Fee\Transaction;

interface ComissionFeeInterface
{
    public function getDepositFee(Transaction $transaction): float;

    public function getWithdrawFee(Transaction $transaction): float;
}