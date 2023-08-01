<?php

namespace App\Repositories\Abstracts;

use App\Models\User;

interface TransferRepositoryInterface extends BaseRepositoryInterface
{
    public function acceptTransfer($transferId);
}
