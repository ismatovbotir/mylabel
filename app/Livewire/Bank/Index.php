<?php

namespace App\Livewire\Bank;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;

class Index extends Component
{
    public $data = [];
    public $bankToken = "";
    public $account = "20208000505552329001";
    public $rDay;
    public $url = "https://ob-api.anorbank.uz";
    public $username = 'bdb_commerce';
    public $password = '*V7RJISZ$Tsp';

    public function mount()
    {
        $this->getBankToken();
        $this->rDay = Date('Y-m-d');
        //dd($this->rDay);
        $this->getBankTransfer();
        
    }

    protected function getBankToken()
    {
        if ($this->bankToken == "") {
            $res = Http::withOptions([
                'verify' => false,
            ])->withHeaders(['Accept' => 'application/json'])->post(
                $this->url . '/api/ext/user/login',
                [
                    "username" => $this->username,
                    "password" => $this->password
                ]
            );
            //dd($res);
            if ($res->status() == 200) {
                $jBody = $res->json();
                $this->bankToken = $jBody['result']['access_token'];
            };
        }
    }

    public function getBankTransfer(){
     // dd($this->rDay);
       $dateStart=Carbon::parse($this->rDay)->timestamp;
       // $dateStart = Carbon::parse($this->rDay)->timestamp;
       //dd($dateStart);
        $dateEnd = Carbon::parse($this->rDay)->endOfDay()->timestamp;
        $this->data=[];
        $this->getBankTransfers($dateStart, $dateEnd);

    }
    protected function getBankTransfers($dateStart, $dateEnd)
    {
        //  dd($this->rDay);
        $body = [
            'jsonrpc' => '2.0',
            'id' => Str::uuid(),
            'method' => 'account.history',
            'params' => [
                'account' => [
                    'number' => $this->account,
                    'mfo' => '01190',
                    'currency' => '840'
                ],
                'filter' => [
                    'from' => ($dateStart+1000) * 1000,
                    'to' => ($dateEnd) * 1000,
                    'type' => 'CREDIT'
                ]
            ]

        ];
       // dd($body);
        $res = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->bankToken
        ])->post(
            $this->url . '/services/open-api-services-ms/api/json-rpc',
            $body
        );



        if ($res->status() == 200) {
            $jsonData = $res->json();
            //dd($jsonData);
            if (empty($jsonData['error'])) {
                $tranz = $jsonData['result']['documents'];
                //dd($tranz);
                foreach ($tranz as $trnz) {
                    if(substr($trnz['date_time'],0,10)==$this->rDay){
                        $this->data[] = [
                            //'                               '
                            'name' => $trnz['corr_name'],
                            'date'=>substr($trnz['date_time'],0,10),
                            'total' => number_format($trnz['amount'] / 100, 0, ',', ' ')
                        ];   
                    }
                    
                }
            }
        }
    }


    public function render()
    {

        return view('livewire.bank.index', ['data' => $this->data]);
    }
}
