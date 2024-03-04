<?php

namespace Gneb\Fee;

use Gneb\Fee\Client;

class Transaction
{
    private int $id;
    private Client $client;
    private string $date;
    private string $type;
    private float $amount;
    private string $currency;
    private static array $transactions = [];

    public function __construct(Client $client, int $id, string $date, string $type, float $amount, string $currency)
    {
        $this->id = $id;
        $this->client = $client;
        $this->date = $date;
        $this->type = $type;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function add(Transaction $transaction): void
    {
        self::$transactions[] = $transaction;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public static function getAll(): array
    {
        return self::$transactions;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getFee(): float
    {
        $typeName = 'get' . ucfirst(strtolower($this->type)) . 'Fee';
        return $this->client->getType()->$typeName($this);
    }

    public function getWithdrawFee(): float
    {
        return $this->client->getType()->getWithdrawFee($this);
    }

    public function getDepositFee(): float
    {
        return $this->client->getType()->getDepositFee($this);
    }

    public function getTransactionsByCleint(Client $client): array
    {
        return array_filter(self::$transactions, function($transaction) use($client) { return $transaction->getClient()->getId() === $client->getId(); });
    }
}
