<?php

namespace Gneb\Fee;

use Gneb\Fee\Client;

class Transaction
{
    private Client $client;
    private string $date;
    private string $type;
    private float $amount;
    private string $currency;
    private static array $transactions = [];

    public function __construct(Client $client, string $date, string $type, float $amount, string $currency)
    {
        $this->client = $client;
        $this->date = $date;
        $this->type = $type;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function add(Transaction $transaction)
    {
        self::$transactions[] = $transaction;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getTransactionsByCleint(Client $client)
    {
        return array_filter(self::$transactions, function($transaction) use($client) { return $transaction->getClient()->getId() === $client->getId(); });
    }
}
