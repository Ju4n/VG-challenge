<?php declare(strict_types=1);

use App\Queue\EventQueue;

require_once(__DIR__ . '/../vendor/autoload.php');

$queue = new EventQueue();

while($event = $queue->dequeue()) {
    echo $event->getMessage() . PHP_EOL;
}

