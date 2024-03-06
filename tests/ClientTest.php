<?php

declare(strict_types=1);

namespace Gneb\Fee\Tests;

use PHPUnit\Framework\TestCase;
use Gneb\Fee\Client;
use Gneb\Fee\Types\Client\TypePrivate;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = new Client(1, 'private');
    }

    /**
     * @param int $expectation
     *
     * @dataProvider dataProviderForId
     */
    public function testId(int $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->client->getId()
        );
    }

    /**
     * @param TypePrivate $expectation
     *
     * @dataProvider dataProviderForType
     */
    public function testType(TypePrivate $expectation)
    {
        $this->assertEquals(
            $expectation,
            $this->client->getType()
        );
    }

    public function dataProviderForId(): array
    {
        return [
            'test id' => [1],
        ];
    }

    public function dataProviderForType(): array
    {
        return [
            'test type' => [new TypePrivate()],
        ];
    }
}