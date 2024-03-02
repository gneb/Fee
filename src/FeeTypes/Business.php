<?php

namespace Gneb\Fee\FeeTypes;

use Gneb\Fee\ComissionFeeInterface;

class Business implements ComissionFeeInterface
{
    public const TYPE = 'business';

    public function getDepositFee()
    {
        return 0.03;
    }

    public function getWithdrawFee()
    {
        return 0.5;
    }
}
