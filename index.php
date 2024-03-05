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
use Gneb\Fee\Helpers\File;
use Gneb\Fee\Helpers\Money;
use Gneb\Fee\Service\GetExchangeRates;

// load .evn variables
$ENV = parse_ini_file(File::checkFileOrExit('.env'));

// check for file parameter
if(!isset($argv[1])){
    echo "file name must be provided. example: php index.php input.csv" . PHP_EOL;
    exit;
}

// check if csv file exists
$file = File::checkFileOrExit($argv[1] ?? null);

// save file lines into memory
$csv = iterator_to_array(Reader::createFromPath($file, 'r'));

// get exchange rates
$rates = GetExchangeRates::execute();

// set rates inside Transaction class static property
Transaction::setExchangeRates($rates->rates);

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
    $transaction = new Transaction($client, $key, $value[0], $value[3], (float)$value[4], $value[5]);
    Transaction::add($transaction);
    Client::add($client);
}


// print fees
foreach (Transaction::getAll() as $transaction) {
    echo Money::format($transaction->getFee()) . PHP_EOL;
}
