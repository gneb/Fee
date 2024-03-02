<?php

declare(strict_types=1);

/**
 * if using mac to read or create the CSV
 */
if (!ini_get("auto_detect_line_endings")) {
    ini_set("auto_detect_line_endings", '1');
}

require __DIR__ . "/vendor/autoload.php";

use Gneb\Fee\Client;
use Gneb\Fee\Transaction;
use League\Csv\Reader;
use League\Csv\Statement;
use Gneb\Fee\Helpers\File;

// check if csv file exists
$file = File::checkFileOrExit($argv[1]);

$csv = iterator_to_array(Reader::createFromPath($file, 'r'));
$clients = [];

/**
 * read csv and store transactions in memory.
 * indexes: 
 * 0 = date, 
 * 1 = id, 
 * 2 = client type,
 * 3 = transaction type, 
 * 4 = amount, 
 * 5 = currency
 */
 foreach ($csv as $key => $value) {
    $client = new Client((int)$value[1], $value[2]);
    $transaction = new Transaction($client, $value[0], $value[3], (float)$value[4], $value[5]);
    Transaction::add($transaction);
    Client::add($client);
}
echo "<pre>";
print_r(Client::getAll()[0]->getTransactions());
// $fee =?