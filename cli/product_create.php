<?php declare(strict_types=1);

require_once(__DIR__ . '/../vendor/autoload.php');

use App\Queue\Event;
use App\Queue\EventQueue;
use App\Service\ProductService;
use App\Storage\Reader;
use App\Storage\Writer;

if ($argc >= 2) {
    $queue = new EventQueue();

    $service = new ProductService(new Writer(), new Reader());    
    $service->createProduct((int) $argv[1], $argv[2], (float) $argv[3]);

    $queue->enqueue(
        new Event(sprintf('Product Created %s %s %s', $argv[1], $argv[2], $argv[3]))
    );
} else {
    echo "ERROR: arguments should be {id} {name} {price}";
}
