<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderItem;

class ItemReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'item:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderItems=OrderItem::with('item')->where('item_id','d1504192-70b3-11ef-810a-d6e330c78673')->where('created_at','>','2025-07-01 00:00:00')->get();
        foreach($orderItems as $orderItem){
            $this->info($orderItem['created_at']." - ".$orderItem['qty']);
        }
        
    }
}
