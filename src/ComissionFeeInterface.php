<?php

namespace Gneb\Fee;

interface ComissionFeeInterface
{
    public function getDepositFee();

    public function getWithdrawFee();

}