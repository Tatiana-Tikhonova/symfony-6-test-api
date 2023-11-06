<?php

namespace App\Service;

class MoneyFormatService
{
    public function format(float $amount): string
    {
        return sprintf('%.2f', $amount) . '&nbsp;руб.';
    }
}
