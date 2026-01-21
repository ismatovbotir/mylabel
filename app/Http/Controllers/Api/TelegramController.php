<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Telegram;
use App\Models\TelegramMessage;
use Exception;

class TelegramController extends Controller
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

        $data = $request->all();
        //$this->sendTelegram('1936361',$data);
        $res=$this->telegramClient($data);
        if($res['status']==0){
            $this->sendTelegram('1936361',$res['message']);
            return;
            
        };
            try {
                $id=$res['id'];
                //$text=$res['text'];
                $business=$res['business'];
                $message=$res['message'];
                //$message = $res['business_m'];

                $newMessage=TelegramMessage::create([
                    'telegram_id' => $id,
                    'bdb'=>$message['bdb'],
                    'type'=>$message['type'],
                    'text' => $message['content'],
                    'reply'=>$message['reply'],
                    'business_connection_id' => $business,
                    'update_id' => $data['update_id'],
                    'message_id' => $message['message_id'],
                    //'reply'=>$message['reply'],
                    'telegram_date' => $message['date']

                ]);
                //$this->sendTelegram('1936361',$newMessage->id);
            } catch (Exception $e) {
                $text= $e->getMessage();
                $this->sendTelegram('1936361',$text);
            }

        //$this->sendTelegram('1936361',$message['text']);
        
        
    }

    public function createClient($client){

    }
    public function telegramClient($data){
        //$text='';
        if (isset($data['business_message'])) {
           // $this->sendTelegram('1936361','business');
           
            $message=$data['business_message'];
            $update=['first_name','last_name','username','language_code','business_connection_id', 'is_premium'];
            $business = $data['business_message']['business_connection_id'];                   
        }else{
            
            $message = $data['message'];
            //$text = $message['text'];
            $business='';
            $update=['first_name','last_name','username','language_code', 'is_premium'];
           
        }
       
        //$id=$message['from']['id'];
        if($message['from']['id']==$message['chat']['id']){
            $lead=$message['from'];
            $bdb=0;
           // $res_id=$message['from']['id'];
        }else{
            //$id=$message['chat']['id'];
            $bdb=1;
          // $res_id=$message['chat']['id'];
           $lead=$message['chat'];

        }
        //$this->sendTelegram('1936361','message');
        //$lead = $message['from'];
        

        // if($id==7102553422){
        //     return [
        //         'status'=>0,
        //         'message'=>'bdb message'
        //     ];
        // }
        
            $content='';
            $phone='';
            $reply=null;
            if(array_key_exists('text',$message)){
                $type='text';
                $content=$message['text'];   
            }elseif(array_key_exists('document',$message)){
                $type='document';
                $content=json_encode($message['document']);

            }elseif(array_key_exists('photo',$message)){
                $type='photo';
                $content=json_encode($message['photo']);

            }elseif(array_key_exists('checklist',$message)){
                $type='photo';
                $content=json_encode($message['photo']);

            }elseif(array_key_exists('location',$message)){
                $type='location';
                $content=json_encode($message['location']);

            }elseif(array_key_exists('video',$message)){
                $type='video';
                $content=json_encode($message['video']);
            }elseif(array_key_exists('voice',$message)){
                $fileId =
                $message['voice']['file_id'];

                $botToken = env('TELEGRAM_BOT_TOKEN');

                $fileInfo = Http::get(
                    "https://api.telegram.org/bot{$botToken}/getFile",
                    ['file_id' => $fileId]
                    )->json();

                $filePath = $fileInfo['result']['file_path'];
                $telegramFileUrl = "https://api.telegram.org/file/bot{$botToken}/{$filePath}";

                $audioContent = Http::get($telegramFileUrl)->body();

                $localPath = storage_path('app/telegram/audio.ogg');
                
                file_put_contents($localPath, $audioContent);    
                
                $response = Http::withToken(env('OPENAI_API_KEY'))
                ->attach(
                            'file',
                            fopen($localPath, 'r'),
                            'audio.ogg'
                        )
                ->post('https://api.openai.com/v1/audio/transcriptions', [
                 'model' => 'whisper-1',
                'language' => 'ru',
            ]);

                $text = $response->json('text');
                
                $this->sendTelegram($lead['id'],json_encode($text));
                $type='voice';
                $content=json_encode($message['voice']);

            }elseif(array_key_exists('contact',$message)){
                $type='contact';
                $content=json_encode($message['contact']);
                if($message['contact']['user_id']==$lead['id']){
                    $phone=$message['contact']['phone_number'];
                    array_push($update,'phone');
                    $this->sendTelegram('1936361',json_encode($update));
                }
            }elseif(array_key_exists('sticker',$message)){
                $type='sticker';
                $content=json_encode($message['sticker']);
                
            }elseif(array_key_exists('video_note',$message)){
                $type='video_note';
                $content=json_encode($message['video_note ']);
                
            }else{
                //$this->sendTelegram('1936361',);
                return [
                        "status"=>0,
                        "message" => json_encode($message)

                ];


            }
            //$this->sendTelegram('1936361','type');
            if(array_key_exists('reply_to_message',$message)){
                $reply=$message['reply_to_message']['message_id'];
            }
           // $this->sendTelegram('1936361','reply');
            try{
                Telegram::upsert(
                                    [
                                        [
                                                'id' => $lead['id'],
                                                'business_connection_id' => $business,
                                                'first_name' => $lead['first_name'] ?? '',
                                                'last_name' => $lead['last_name'] ?? '',
                                                'username' => $lead['username'] ?? '',
                                                'language_code' => $lead['language_code'] ?? '',
                                                'is_premium' => $lead['is_premium'] ?? false,
                                                'phone'=>$phone
                                            ]
                                        ],
                                        ['id'],
                                        $update
                                );
            }catch(Exception $e) {
                                $res=[
                                    "status"=>0,
                                    "message" =>'user:  '. $e->getMessage()
                                ];
                                return $res;
                                
            }
        
            try{
              $res=[
                    'id'=>$lead['id'],
                    //'reply'=>$reply,
                    'status'=>1,
                    'message'=>[
                        'type'=>$type,
                        'content'=>$content,
                        'date'=>$message['date'],
                        'message_id'=>$message['message_id'],
                        'reply'=>$reply,
                        'bdb'=>$bdb
                    ],
                    'business'=>$business
                    
                ];  
            }catch(Exception $e) {
                $res=[
                    "status"=>0,
                    "message" =>'res:  '. $e->getMessage()
                ];
                //return $res;
                
}
            
            
                    
        
                
       // $this->sendTelegram('1936361',$text);
        return $res;
             
    }

    public function sendTelegram($id='1936361',$text='test'){
        $response = Http::withBody(json_encode(
            [
                //"business_connection_id"=>$message->business_connection_id,
                "chat_id" => $id,
                "text" => $text,
                "parse_mode" => "HTML"
            ]
        ))
        ->post("https://api.telegram.org/bot525501231:AAHteYYF_PI174fPeyZZmuB6I1xVLIJg_oQ/sendMessage");

    }

    public function show(string $id)
    {
        //
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
}
