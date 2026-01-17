<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AnorBank extends Command
{
    public $data=[];
    public $bankToken="";
    public $account="20208000505552329001";
    public $rDay;
    public $url="https://ob-api.anorbank.uz";
    public $username='bdb_commerce';
    public $password='*V7RJISZ$Tsp';
    
    
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anor:bank';

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
        $this->getBankToken();
        $dateStart=Carbon::today();
        $dateEnd=Carbon::today()->endOfDay();
        $this->info($dateEnd);
       // $this->accountHistory($dateStart,$dateEnd);
        
       $this->info($dateStart);
        
    }
    public function getBankToken(){
        if($this->bankToken==""){
            $res = Http::withOptions([
                'verify' => false,
             ])->withHeaders(['Accept'=>'application/json'])->post($this->url.'/api/ext/user/login',
                [
                    "username"=> $this->username,
                    "password"=> $this->password
                ]
            );
           //dd($res);
            if($res->status()==200){
                $jBody=$res->json();
                $this->bankToken=$jBody['result']['access_token'];
            };
        }
    } 
    
    public function accountHistory($dateStart,$dateEnd){
       // $today = Carbon::today();

        // Beginning of the day
       
        $body=[
            'jsonrpc'=>'2.0',
            'id'=>Str::uuid(),
            'method'=>'account.history',
            'params'=>[
                'account'=>[
                    'number'=>$this->account,
                    'mfo'=>'01190',
                    'currency'=>'840'
                ],
                'filter'=>[
                    'from'=>$dateStart*1000,
                    'to'=>$dateEnd*1000,
                    'type'=>'DEBIT'
                ]
            ]

        ];
        $this->sendMessage($body);
        if($this->bankToken!==""){
            $res = Http::withOptions([
                'verify' => false,
             ])->withHeaders([
                                'Accept'=>'application/json',
                                'Authorization'=>'Bearer '.$this->bankToken
                            ])->post($this->url.'/services/open-api-services-ms/api/json-rpc',
                $body
            );
           $this->info($res->body());
            if($res->status()==200){
                dd($res->json());
                
            }else{ 
                $jBody=$res->json();
                //dd($jBody);
                if($jBody['error']){
                    //dd($jBody['error']);
                    $this->sendMessage($res->body());
                }

            }
        }



    }
    public function sendMessage($text,$id='1936361')
    {
        if($this->data!=''){
            $response = Http::withBody(json_encode(
            [
                "chat_id" => $id,
                "text" => $text,
                "parse_mode" => "HTML"
            ]
        ))
            ->post("https://api.telegram.org/bot525501231:AAHteYYF_PI174fPeyZZmuB6I1xVLIJg_oQ/sendMessage");

        //$jsonRes = json_decode($response->body());
        }
        
    }
}
