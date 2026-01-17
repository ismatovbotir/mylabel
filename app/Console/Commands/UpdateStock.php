<?php

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stock';

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
        Item::query()->update(['qty'=>0]);
        $res = Http::withHeaders([
            'Authorization' => 'Basic YWRtaW46aW5mb0Bwb3MudXo=',
            'Accept' => 'application/json'
        ])->get('localhost:8000/base/hs/crm/stock');
        if($res->status()==200){
                $jsonData=$res->json();
                //dd($jsonData['data']);
                $dataArr=$jsonData["data"];
                foreach($dataArr as $idx=>$data){
                    //dd($data);
                    try{
                        Item::where('id',$data['id'])->update(['qty'=>$data['qty'],'price'=>$data['price']]);
                           
                       
                    }catch(\Exception $e){
                        dd($data);
                    }
                    
                    //$newItem->prices->upsert();
                    //dd($newItem);
                    //$this->prices();
                }
        $this->info('done...');
        }else{
            $this->info('error...');
        }
    }
}
