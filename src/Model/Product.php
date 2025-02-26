<?php declare(strict_types=1);

namespace App\Model;

use JsonSerializable;

class Product implements JsonSerializable {
    public function __construct(
        protected int $id, 
        protected string $name, 
        protected float $price
    ) {
        //
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price
        ];
    }

    public function setName(string $name) 
    {
        $this->name = $name;
    }

    public function setPrice(float $price) 
    {
        $this->price = $price;
    }
}
