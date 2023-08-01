<?php

namespace App\Exceptions;

class NotEnoughBalanceHttpException extends BaseHttpException
{
    protected $message = 'Недостаточно средств на балансе';

    protected $code = 409;
}
