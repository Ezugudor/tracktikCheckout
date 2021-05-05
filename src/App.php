<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';



use App\Services\ElectronicItem\Console;
use App\Services\ElectronicItem\Controller;
use App\Services\ElectronicItems;
use App\Services\ElectronicItem\Microwave;
use App\Services\ElectronicItem\Television;

class App
{

    public function init()
    {

        $wired = new Controller(100);
        $remote = new Controller(300, false);

        //console shopping
        $consoleExtra = [$wired, $wired, $remote, $remote];
        $con = new Console(100, $consoleExtra);


        //televisions shopping
        $tv1Extras = [$remote, $remote];
        $tv2Extras = [$remote];

        $tv1 = new Television(800, $tv1Extras);
        $tv2 = new Television(500, $tv2Extras);

        //microwave shopping
        $microwave = new Microwave(200);


        //add all items to the cart and proceed to checkout
        $cart = [$con, $tv1, $tv2, $microwave];
        $checkout = new ElectronicItems($cart);

        /*******************************************
         * SCENARIO 1 - sort items and output total.
         *******************************************/
        $sortedItem = $checkout->getSortedItems('price');
        $totalPrice = $checkout->getTotalPrice();
        echo "All items total price = {$totalPrice} \n\r";



        /********************************************************
         * SCENARIO 2 - Console item plus its controllers prices.
         ********************************************************/
        $consoleTotalPrice = $checkout->getTotalPriceByType('console');
        echo "Console item total price = {$consoleTotalPrice} \n\r";
    }
}
