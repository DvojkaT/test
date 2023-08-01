<?php

namespace App\Domain\Enums;

enum TransferStatusEnum: string
{
    case IN_ORDER = 'in_order'; // В ожидании перевода
    case FINISHED = 'finished'; // Перевод завершен
}
