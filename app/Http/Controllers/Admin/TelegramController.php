<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Telegram;
use App\Models\TelegramMessage;
use Illuminate\Database\QueryException;
use App\Models\Order;

class TelegramController extends Controller
{
    private $chat_id="";
    private $token="";
    
    public function __construct()
    {
        $this->chat_id="-1002814627370";
        $this->token="525501231:AAHteYYF_PI174fPeyZZmuB6I1xVLIJg_oQ";
    } 

    public function index()
    {
        
        //dd($data);
        return view('telegram.index');   
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
      
        
    }
    
    public function show(string $id)
    {
        return view('telegram.show',['id'=>$id]);
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

    public function sendmessage($status,$order,$doc="",$type=1,$text=""){
        if($type==1){

        
            if($order->telegram!=null){
            
                $response=$this->deleteMessage($order->telegram);
                //dd($response->body());

            }
            
            $orderText = $order->company->stir . "\n" . $order->company->fullName ;
            $orderText.= "\n--------------\n";
            $ttext=($order->company->one_time==1 ? "Bir marotabalik Shartnoma" : "Yillik shartnoma");
            $orderText.="❗️❗️❗️".$ttext;
            $orderText.="\nШартнома: ".$order->agreement_number." Счет: ".$order->bill;
            $orderText.="\nERP da Счет: ".$doc."\n***************\n";
            if($order->comment!=''){
                $orderText="<b>Muhim!!! ".$order->comment."</b>\n".$orderText;
            }
            $total = 0;
            // foreach ($order->orderItems as $orderItem) {
            //     $orderText .= $orderItem->item->acc_code . " - " . $orderItem->item->acc_name . "\n";
            //     $orderText .= number_format($orderItem->qty, 0, '.', ' ') . " x " . number_format($orderItem->price, 0, '.', ' ') . " = " . number_format($orderItem->qty * $orderItem->price, 0, '.', ' ') . "\n";
            //     $orderText .= "=========\n";
            //     $total += $orderItem->qty * $orderItem->price;
            // }
            // $orderText .= "<b>Жами: </b>" . number_format($total, 0, '.', ' ');
            $orderText .= "\nhttps://mylabel.uz/bills/".$order->id;
            //dd($orderText);
            switch($status){
                case "bill":
                    
                    $text = "@Gayratbek_21\n📃 Счет беринг !!!\n" . $orderText;

                break;
                case "delivery":
                    $text = "@Gayratbek_21\n🚚 Yetkazildi !!!\n" . $orderText;
                break;
            }
            $tBody=[
                 "chat_id" => $this->chat_id,
                "text" => $text,
                "parse_mode" => "HTML"

            ];
    }else{
        $tBody=[
            "chat_id" => 1936361,
           "text" => $text,
           "parse_mode" => "HTML"

       ];

    }
       
        
        
        $response = Http::withBody(json_encode(
            $tBody
        ))
            ->post("https://api.telegram.org/bot".$this->token."/sendMessage");

        
        return $response;

    }
    public function deleteMessage($message_id){
        $response = Http::withBody(json_encode(
            [
                "chat_id" =>$this->chat_id,
                "message_id" => $message_id
            ]
        ))
            ->post("https://api.telegram.org/bot".$this->token."/deleteMessage");
        
        return $response;
    }

   
    
}
