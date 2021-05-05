<?php

namespace App\Services\ElectronicItem;

use App\Contract\IElectronicItem;
use Exception;
use App\Services\ElectronicItem;

class Television extends ElectronicItem implements IElectronicItem
{

    public $extras;
    public $type = "television";

    public function __construct(int $price, array $extras = [])
    {
        $this->setPrice($price);
        $this->setType("television");
        $this->maxExtras($extras);
        return $this->response();
    }

    public function maxExtras($extras)
    {
        //no need to perform any check here since Television extra is unlimited.
        $this->addExtra($extras);
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
