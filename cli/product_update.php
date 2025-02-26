<?php declare(strict_types=1);

require_once(__DIR__ . '/../vendor/autoload.php');

use App\Queue\EventQueue;
use App\Service\ProductService;
use App\Storage\Reader;
use App\Storage\Writer;

if ($argc >= 2) {

    $name = '';
    $price = 0;

    $service = new ProductService(new Writer(), new Reader());    

    if (!is_numeric($argv[2])) {
        $name = $argv[2];
    }

    if (is_numeric($argv[2])) {
        $price = $argv[2];
    }


    $service->updateProduct((int) $argv[1], $name, (float) $price);
} else {
    echo "ERROR: arguments should be {id} {name} {price}";
}

