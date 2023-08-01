<?php

namespace App\Http\Controllers;

use App\Exceptions\NotEnoughBalanceHttpException;
use App\Http\Requests\TransferMoneyRequest;
use App\Http\Resources\TransferResource;
use App\Services\Abstracts\TransferServiceInterface;

class TransferController extends Controller
{
    private TransferServiceInterface $service;

    public function __construct(TransferServiceInterface $service)
    {
        $this->service = $service;
    }

    public function transferMoney(TransferMoneyRequest $request)
    {
        $data = $request->validated();
        if (!$this->service->checkUserBalanceDistinction($data['amount'], $data['sender_id'])) {
            throw new NotEnoughBalanceHttpException();
        }

        return new TransferResource($this->service->newTransfer($data));
    }

}
