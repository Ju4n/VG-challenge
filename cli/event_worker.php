<?php declare(strict_types=1);

use App\Queue\EventQueue;

require_once(__DIR__ . '/../vendor/autoload.php');

$queue = new EventQueue();

while(true) {
    $event = $queue->dequeue();
    echo $event->getMessage();
    sleep(1);
}

