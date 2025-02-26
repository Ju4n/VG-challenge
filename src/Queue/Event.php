<?php declare(strict_types=1);

namespace App\Queue;

use JsonSerializable;

class Event implements JsonSerializable {

    public function __construct(protected readonly string $message)
    {
        //    
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function jsonSerialize(): mixed
    {
        return ['message' => $this->message];
    }

}
