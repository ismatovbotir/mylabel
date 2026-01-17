<?php

namespace App\Livewire\Bill;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Bill;
use App\Models\Order;

class Payme extends Component
{
    public $order_id = '';
    public $bill_id='';
    
    public $phone = '';

    public function mount($id)
    {
        $this->bill_id = $id;
        $bill=Bill::where('id',$id)->with('order.company')->first();
        $this->phone=$bill->order->company->mob;
    }
    public function sendPayme(){
        $bill=Bill::where('id',$this->bill_id)->first();

        $response = Http::withHeaders([
            'X-Auth' => "678ddfd1320c36e44deb17af:9mV2r%T%noPf0RTBBAmWWXn7Ow7%U4cJ2tyC",
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ])->post('https://checkout.paycom.uz/api', [
            
                "id"=> 123,
                "method"=> "receipts.send",
                "params"=> [
                    "id"=> $bill->doc,
                    "phone"=> $this->phone
                ]
            

        ]);

        // Optional: Get response data
        $data = $response->json();
        //dd($data);
        //return $data;
        return to_route('admin.order.index');
    }

  

    public function render()
    {
        return view('livewire.bill.payme');
    }
}
