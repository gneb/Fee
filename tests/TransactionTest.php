<?php

declare(strict_types=1);

namespace Gneb\Fee\Tests;

use PHPUnit\Framework\TestCase;
use Gneb\Fee\Client;
use Gneb\Fee\Transaction;
use Gneb\Fee\Service\GetExchangeRates;
use Gneb\Fee\Helpers\File;

class TransactionTest extends TestCase
{
    public function setUp()
    {
        global $ENV;
        $ENV = parse_ini_file(File::checkFileOrExit('.env'));
        Transaction::setExchangeRates(json_decode('{"rates": {"EUR": 1, "USD": 1.1497, "JPY": 129.53}}')->rates);

        // add transaction #1
        $client = new Client(1, 'private');
        $transaction1 = new Transaction($client, 0, '2014-12-31', 'withdraw', 1200.00, 'EUR');
        Transaction::add($transaction1);
        Client::add($client);

        // add transaction #2
        $transaction2 = new Transaction($client, 1, '2015-01-01', 'withdraw', 3000000, 'JPY');
        Transaction::add($transaction2);

        // add transaction #3
        $transaction3 = new Transaction($client, 1, '2016-01-01', 'withdraw', 50.00, 'EUR');
        Transaction::add($transaction3);
    }

    /**
     * @param float $expectation
     *
     * @dataProvider dataProviderForFee
     */
    public function testFee(float $expectationFirst, float $expectationSecond, float $expectationThird)
    {
        $allTransactions = Transaction::getAll();

        $this->assertEquals(
            $expectationFirst,
            $allTransactions[0]->getFee()
        );

        $this->assertEquals(
            $expectationSecond,
            $allTransactions[1]->getFee()
        );

        $this->assertEquals(
            $expectationThird,
            $allTransactions[2]->getFee()
        );
    }

    public function dataProviderForFee(): array
    {
        return [
            'expected fee' => [0.6, 9000, 0],
        ];
    }
}