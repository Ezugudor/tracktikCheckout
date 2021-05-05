<?php

namespace App\Services;

use App\Services\ElectronicItem;

class ElectronicItems
{
    private $items = array();
    private $totalPrice;
    public function __construct(array $items)
    {
        $this->items = $items;
        $this->setTotalPrice();
    }
    /**
     * Returns the items depending on the sorting type requested
     *
     * @return array
     */
    public function getSortedItems($type)
    {
        $sorted = array();
        foreach ($this->items as $key => $item) { //added key to differentiate between same price
            $sorted[($item->$type * 100 + $key)] = $item;
        }
        ksort($sorted, SORT_NUMERIC);
        return $sorted;
    }
    /**
     *
     * @param string $type
     * @return array
     */
    public function getItemsByType($type)
    {
        if (in_array($type, ElectronicItem::getTypes())) {
            $callback = function ($item) use ($type) {
                return $item->type == $type;
            };
            $items = array_filter($this->items, $callback);
            return $items;
        }
        return false;
    }


    /**
     * Navigate through the array of items and it's extras 
     * and sum their prices.
     * @param array $items Array of items whose total price as well as the embedded extras is to be computed
     * @return $price Computed price.
     */
    public function calculateItemsPrice(array $items)
    {
        $price = 0;
        foreach ($items as $item) {
            $price += $item->price;
            if (property_exists($item, 'extras') && count($item->extras)) {
                foreach ($item->extras as $extra) {
                    $price += $extra->price;
                }
            }
        }
        return $price;
    }

    public function setTotalPrice()
    {
        $price = $this->calculateItemsPrice($this->items);
        $this->totalPrice =  $price;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }


    public function getTotalPriceByType(string $type)
    {
        $items = $this->getItemsByType($type);
        $price = $this->calculateItemsPrice($items);
        return $price;
    }
}
