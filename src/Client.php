<?php

declare(strict_types=1);

namespace Gneb\Fee;

use Gneb\Fee\Helpers\Entity;

class Client
{
    private int $id;
    private ComissionFeeInterface $type;
    private static array $clients = [];

    public function __construct(int $id, string $type)
    {
        $this->id = $id;
        $targetType = Entity::checkClassOrExit('\\Gneb\\Fee\\Types\Client\\Type'.ucfirst(strtolower($type)));
        $this->type = new $targetType();
        $this->transactions = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): ComissionFeeInterface
    {
        return $this->type;
    }

    public function getTransactions(): array
    {
        return Transaction::getTransactionsByCleint($this);
    }

    public static function add(Client $client): void
    {
        if (!array_filter(self::$clients, function ($user) use ($client) { return $user->getId() === $client->getId(); })) {
            self::$clients[] = $client;
        }
    }

    public static function getAll(): array
    {
        return self::$clients;
    }
}
