<?php

namespace Gneb\Fee\FeeTypes;

use Gneb\Fee\ComissionFeeInterface;

class TypePrivate implements ComissionFeeInterface
{
    public function getDepositFee()
    {
        return 0.03;
    }

    public function getWithdrawFee()
    {
        
    }
}
