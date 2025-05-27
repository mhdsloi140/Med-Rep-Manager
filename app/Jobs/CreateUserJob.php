<?php

namespace App\Jobs;

use App\Enums\UserableEnum;
use App\Mail\SendPasswordMail;
use App\Models\Delegate;
use App\Models\User;
use App\Services\DelegateService;
use Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class CreateUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
   public $data;
    public function __construct($data)
    {
        $this->data=$data;

    }

    /**
     * Execute the job.
     */
    public function handle(  DelegateService $delegateService): void
    {
            
        $delegateService->store($this->data);
    }
}





