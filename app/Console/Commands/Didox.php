<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use WebSocket\Client;

class Didox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    
    protected $signature = 'didox:doc';

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
        $client = new Client(
            "wss://127.0.0.1:64443/service/cryptapi",
            [
                'timeout' => 10,
                'headers' => [
                    "Host: 127.0.0.1:64443",
                    "Origin: https://mylabel.uz"
                ],
                'context' => stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ]
                ])
            ]
        );

        // Точное сообщение по документации
        $payload = [
            "plugin" => "pfx",
            "name"   => "list_all_certificates"
        ];

        $client->send(json_encode($payload));

        $response = $client->receive();

        $client->close();
        $this->info($response);
        return json_decode($response, true);
    
    }
}
