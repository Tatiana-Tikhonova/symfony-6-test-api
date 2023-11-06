<?php

namespace App\Service;

class RandomAmountService
{
    public function __construct(
        private readonly MoneyFormatService $moneyFormatService,
    )
    {

    }
    public function getNumber(): string
    {
        return $this->moneyFormatService->format(rand(1, 42)) ;
    }

}
