<?php

namespace App\Jobs;

use App\Services\Abstracts\TransferServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AcceptTransferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $transferId;

    private TransferServiceInterface $transferService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $transferId, TransferServiceInterface $transferService)
    {
        $this->transferId = $transferId;
        $this->transferService = $transferService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->transferService->acceptTransfer($this->transferId);
    }
}
