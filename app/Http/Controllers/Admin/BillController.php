<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bill=Bill::where('order_id',$id)->first();
        $order=Order::where('id',$id)->with('orderItems.item')->first();
        if($bill==null){

        
        $bill=Bill::create([
            'order_id'=>$order->id,
            'type'=>'payme'

        ]);
        
        }
        //dd($bill);
        if($bill->doc){

        }else{
        $pBody=$this->payme($this->paymeBody($order,$bill->id));
        $bill->update(['doc'=>$pBody['result']['receipt']['_id']]);
        }
        Order::where('id',$id)->update(['bill'=>'payme']);
        return view('bill.payme',['order'=>$order,'bill'=>$bill]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    protected function paymeBody($order,$id){
        $total=0;
        $items=[];
        foreach($order->orderItems as $orderItem){
            $item=[
                'discount' => 0,
                'title' => $orderItem->item->acc_name,
                'price' => $orderItem->price*1.011*100,
                'count' => $orderItem->qty,
                'code' => $orderItem->item->mxik,
                'units' => 123456,
                'vat_percent' => 12,
                'package_code' => $orderItem->item->package_code,

            ];
            array_push($items,$item);
            $total=$total+($orderItem->qty*$orderItem->price*1.011);
        }
        
        return $body=[
            'id' => $id,
            'method' => 'receipts.create',
            'params' => [
                'amount' => $total*100,
                'account' => [
                    'order_id' => $order->id,
                ],
                'detail' => [
                    'receipt_type' => 0,
                    'shipping' => [
                        'title' => 'BDB commerce',
                        'price' => 0,
                    ],
                    'items' => $items,
                ],
            ],
        ];

    }
    protected function payme($body){
        $response = Http::withHeaders([
            'X-Auth' => "678ddfd1320c36e44deb17af:9mV2r%T%noPf0RTBBAmWWXn7Ow7%U4cJ2tyC",
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ])->post('https://checkout.paycom.uz/api', $body);

        // Optional: Get response data
        $data = $response->json();
        return $data;
    }
}
