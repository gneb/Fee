<?php

namespace Gneb\Fee;

interface ComissionFeeInterface
{
    public function getDepositFee(): float;

    public function getWithdrawFee(): float;

}