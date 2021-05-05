<?php

namespace App\Contract;

interface IElectronicItem
{
    /**
     * Checks if an electronic item is allowed to have
     * extra items or not, and if yes, what is the limit.
     * @param array $extras An array of extra items
     */
    public function maxExtras($extras);
}
