<?php

namespace Gneb\Fee\FeeTypes;

use Gneb\Fee\ComissionFeeInterface;

class TypeBusiness implements ComissionFeeInterface
{
    public function getDepositFee()
    {
        return 0.03;
    }

    public function getWithdrawFee()
    {
        return 0.5;
    }
}
