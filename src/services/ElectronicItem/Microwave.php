<?php

namespace App\Services\ElectronicItem;

use App\Contract\IElectronicItem;
use Exception;
use App\Services\ElectronicItem;

class Microwave extends ElectronicItem implements IElectronicItem
{

    public $type = "microwave";
    public function __construct(int $price, array $extras = [])
    {
        $this->setPrice($price);
        $this->setType("microwave");
        $this->maxExtras($extras);
        return $this->response();
    }


    public function maxExtras($extras)
    {
        if (!empty($extras)) {
            throw new Exception("Microwave cannot have an extra item", 1);
        }
    }

    public function response()
    {
        return [
            'price' => $this->getPrice(),
            'type' => $this->getType(),
        ];
    }
}
