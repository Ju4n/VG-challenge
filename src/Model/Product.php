<?php declare(strict_types=1);

namespace App\Model;

class Product {
    public function __construct(
        protected int $id, 
        protected string $name, 
        protected float $price
    ) {
        //
    }

    public function toArray(): array
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

    public static function fromFileData(int $id, string $fileData) 
    {
        $data = json_decode($fileData);
        self::$id = $id; 
        if ($data->name) {
            self::$name = $data->name;
        }

        if ($data->price) {
            self::$price = $data->price;
        }

        return new self($id, self::$name, self::$price);
    }
}
