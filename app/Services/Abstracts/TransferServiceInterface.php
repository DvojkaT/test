<?php

namespace App\Services\Abstracts;

use Illuminate\Support\Collection;

interface TransferServiceInterface
{
    /**
     * Проверка, хватит ли у пользователя денег на балансе
     */
    public function checkUserBalanceDistinction(int $amount, int $userId): bool;

    /**
     * Получение переводов, которые ещё не выполнились
     */
    public function getOrderTransfers(): Collection;

    /**
     * Процесс переноса денег с одного пользователя, на другого
     */
    public function acceptTransfer(int $transferId): void;
}
