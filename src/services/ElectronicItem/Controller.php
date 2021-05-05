<?php

namespace App\Services\ElectronicItem;

use App\Contract\IElectronicItem;
use Exception;
use App\Services\ElectronicItem;



class Controller extends ElectronicItem implements IElectronicItem
{
    public $type = "controller";
    public function __construct(int $price, bool $wired = true)
    {
        $this->setPrice($price);
        $this->setType("controller");
        $this->setWired($wired);
        return $this->response();
    }

    //Controller is the Extra item so this method has no say in this jurisdiction :)
    public function maxExtras($extras)
    {
        if (!empty($extras)) {
            throw new Exception("Controller cannot have an extra item", 1);
        }
    }

    public function response()
    {
        return [
            'price' => $this->getPrice(),
            'wired' => $this->getWired(),
            'type' => $this->getType(),
        ];
    }
}
