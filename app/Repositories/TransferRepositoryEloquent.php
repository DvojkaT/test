<?php

namespace App\Repositories;

use App\Domain\Enums\TransferStatusEnum;
use App\Models\Transfer;
use App\Repositories\Abstracts\TransferRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TransferRepositoryEloquent extends BaseBaseRepository implements TransferRepositoryInterface
{
    public function model(): string
    {
        return Transfer::class;
    }

    public function acceptTransfer($transferId): void
    {
        try {
            DB::transaction(function () use ($transferId) {
                $transaction = $this->findByColumn('id', $transferId)->first();
                $transaction->load(['sender', 'receiver']);

                $sender = $transaction->sender;
                $receiver = $transaction->receiver;

                $receiver->balance += $transaction->amount;
                $sender->balance -= $transaction->amount;

                $receiver->save();
                $sender->save();

                $transaction->status = TransferStatusEnum::FINISHED->name;
                $transaction->save();
            });
        } catch (\Exception $exception) {
            DB::rollBack();
        }

    }
}
