<?php

namespace App\Service;

class ErrorHandlerService
{

    public function setRequestErrorMsg($string): string
    {
        return 'Incorrect request ' . $string . '! Read documentation on https://github.com/Tatiana-Tikhonova/symfony-6-test-api';

    }
    public function setFieldsErrorMsg(string $type='value', $string): string
    {
        return 'Incorrect fields ' .$type. $string . '! Read documentation on https://github.com/Tatiana-Tikhonova/symfony-6-test-api';

    }

}
