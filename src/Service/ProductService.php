<?php declare(strict_types=1);

namespace App\Service;

use App\Model\Product;
use App\Storage\Reader;
use App\Storage\Writer;

use RuntimeException;

class ProductService 
{
    public function __construct(
        protected readonly Writer $writer, 
        protected readonly Reader $reader
    ) {

    }

    public function findProductById(int $id) 
    {
        try {
            $product = $this->reader->read((string) $id);
        } catch (RuntimeException) {
            return null;
        }

        return $product;
    }

    public function createProduct(int $id, string $name, float $price)
    {
        if (!is_null($this->findProductById($id))) {
            throw new RuntimeException('Product Already Exists');
        }

        $product = new Product($id, $name, $price);
        $this->writer->create((string) $id, json_encode($product->toArray()));
    }

    public function updateProduct(int $id, string $name = '', float $price = 0)
    {
        $fileData = json_decode($this->reader->read((string) $id));
        $product = new Product($id, $fileData->name, $fileData->price);

        if (!empty($name)) {
            $product->setName($name);
        }

        if (!empty($price)) {
            $product->setPrice($price);
        }

        $this->writer->update((string) $id, json_encode($product->toArray()));
    }

    public function deleteProduct(int $id): bool
    {  
        if (is_null($this->findProductById($id))) {
            throw new RuntimeException('Product Doesnt Exists');
        }

        $this->writer->delete((string) $id);

        return true;
    }}
