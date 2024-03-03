<?php

namespace Gneb\Fee;
use Gneb\Fee\Transaction;

class Client
{
    private int $id;
    private ComissionFeeInterface $type;
    private static array $clients = [];
    private $transactions;

    public function __construct(int $id, string $type)
    {
        $this->id = $id;
        $targetType = '\\Gneb\\Fee\\FeeTypes\\Type' . ucfirst(strtolower($type));
        $this->type = new $targetType();
        $this->transactions = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTransactions(): array
    {
        return Transaction::getTransactionsByCleint($this);
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public static function add(Client $client): void
    {
        if(!array_filter(self::$clients, function($user) use($client) { return $user->getId() === $client->getId(); })){
            self::$clients[] = $client;
        }
    }

    public static function getAll(): array
    {
        return self::$clients;
    }
}
