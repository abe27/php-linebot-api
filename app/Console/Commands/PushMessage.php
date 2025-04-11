<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LINE\Clients\MessagingApi\Model\PushMessageRequest;
use LINE\Clients\MessagingApi\Model\TemplateMessage;
use LINE\Clients\MessagingApi\Model\TextMessage;

class PushMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:push-message';

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
        $client = new \GuzzleHttp\Client();
        $config = new \LINE\Clients\MessagingApi\Configuration();
        $config->setAccessToken(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $messagingApi = new \LINE\Clients\MessagingApi\Api\MessagingApiApi(
            client: $client,
            config: $config,
        );

        $user = $messagingApi->getProfile('U7620f077b8d1218be94d27211729be5a');
        $message = new TemplateMessage([
            'type' => 'template',
            "altText" => "this is a buttons template",
            "template" => [
                "type" => "buttons",
                "title" => "Title",
                "text" => "Text",
                "actions" => [
                    [
                        "type" => "message",
                        "label" => "Action 1",
                        "text" => "Action 1"
                    ],
                    [
                        "type" => "message",
                        "label" => "Action 2",
                        "text" => "Action 2"
                    ]
                ]
            ]
        ]);
        $request = new PushMessageRequest([
            'to' => $user['userId'],
            'messages' => [$message],
        ]);
        $messagingApi->pushMessage($request);
    }
}
