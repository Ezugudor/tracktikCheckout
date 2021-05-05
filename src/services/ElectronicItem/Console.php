<?php

namespace App\Services\ElectronicItem;

use App\Contract\IElectronicItem;
use Exception;
use App\Services\ElectronicItem;

class Console extends ElectronicItem implements IElectronicItem
{
    public $extras;
    public $type = "console";

    public function __construct(int $price, array $extras = [])
    {
        $this->setPrice($price);
        $this->setType("console");
        $this->maxExtras($extras);
        return $this->response();
    }

    public function maxExtras($extras)
    {
        if (!empty($extras)) {
            if (count($extras) > 4) {
                throw new Exception("Console items can only have a maximum of 4 items.", 1);
            }
            $this->addExtra($extras);
        }
    }

    public function addExtra($extras)
    {
        $this->extras = $extras;
    }

    public function getExtras()
    {
        return $this->extras;
    }

    public function response()
    {
        return [
            'price' => $this->getPrice(),
            'type' => $this->getType(),
            'extras' => $this->getExtras(),
        ];
    }
}
