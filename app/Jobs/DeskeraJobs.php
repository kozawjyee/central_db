<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\DSK_Customer;
use App\Models\DSK_Invoice;
use App\Models\DSK_Item;
use Exception;

class DeskeraJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DSK_Customer $dsk_customer, DSK_Item $dSK_Item , DSK_Invoice $dSK_Invoice)
    {
        try{
            $dsk_customer->getLastCustomerIdfromDeskera();
            // $dSK_Item->postItem();
            $dSK_Invoice->postInvoice();
        }catch(Exception $e){
            Log::channel('deskera')->info($e);
        }
    }
}
