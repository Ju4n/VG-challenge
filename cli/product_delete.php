<?php declare(strict_types=1);

require_once(__DIR__ . '/../vendor/autoload.php');

use App\Queue\EventQueue;
use App\Service\ProductService;
use App\Storage\Reader;
use App\Storage\Writer;

if ($argc >= 2) {
    $service = new ProductService(new Writer(), new Reader());    
    $service->deleteProduct((int) $argv[1]);
} else {
    echo "ERROR: arguments should be {id}";
}
