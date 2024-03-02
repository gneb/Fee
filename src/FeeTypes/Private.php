<?php

declare(strict_types=1);

namespace Gneb\Fee\ComissionFeeInterface;

class Private implements ComissionFeeInterface
{
    public const TYPE = 'private';

    public function getDepositFee()
    {
        return 0.03;
    }

    public function getWithdrawFee()
    {
        
    }
}
