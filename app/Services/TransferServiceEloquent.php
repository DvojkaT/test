<?php

namespace App\Services;

use App\Domain\Enums\TransferStatusEnum;
use App\Repositories\Abstracts\TransferRepositoryInterface;
use App\Repositories\Abstracts\UserRepositoryInterface;
use App\Services\Abstracts\TransferServiceInterface;
use Illuminate\Support\Collection;

class TransferServiceEloquent implements TransferServiceInterface
{
    private UserRepositoryInterface $userRepository;
    private TransferRepositoryInterface $repository;

    public function __construct(TransferRepositoryInterface $repository, UserRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function checkUserBalanceDistinction(int $amount, int $userId): bool
    {
        $user = $this->userRepository->getUserById($userId);

        if ($user->balance - $amount < 0) {
            return false;
        }

        return true;
    }

    public function newTransfer($data)
    {
        return $this->repository->create($data);
    }


    public function getOrderTransfers(): Collection
    {
        return $this->repository->findByColumn('status', TransferStatusEnum::IN_ORDER->name);
    }

    public function acceptTransfer(int $transferId): void
    {
        $this->repository->acceptTransfer($transferId);
    }
}
