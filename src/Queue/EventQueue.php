<?php declare(strict_types=1);

namespace App\Queue;

class EventQueue
{
    const EVENT_FILE = __DIR__ . '/../../storage/event_file.json';

    public function __construct(
    ) {
        // initialize
        if (!file_exists(self::EVENT_FILE)) {
            file_put_contents(self::EVENT_FILE, json_encode([]));
        }
    }

    public function enqueue(Event $event): void
    {
        $events = $this->getEvents();
        $events[] = json_encode($event);

        file_put_contents(self::EVENT_FILE, json_encode($events));
    }

    public function dequeue(): ?Event
    {
        $events = $this->getEvents();

        if (!$events) {
            return null;
        }

        $firstValue = json_decode(array_shift($events), true);
        $event = new Event($firstValue['message']);

        file_put_contents(self::EVENT_FILE, json_encode($events));

        return $event;
    }

    public function getEvents(): ?array 
    {
        return json_decode(file_get_contents(self::EVENT_FILE), true);
    }
}
