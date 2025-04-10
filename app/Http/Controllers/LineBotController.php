<?php

namespace App\Http\Controllers;

use App\Cutoms\UpdateStock;
use App\Models\LineBot;
use App\Models\LineUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;

class LineBotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return null;
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
        // Log::info($request);
        // $destination = $request['destination'];
        $client = new \GuzzleHttp\Client();
        $config = new \LINE\Clients\MessagingApi\Configuration();
        $config->setAccessToken(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $messagingApi = new \LINE\Clients\MessagingApi\Api\MessagingApiApi(
            client: $client,
            config: $config,
        );

        foreach ($request['events'] as $event) {
            $msgType = $event['message']['type'];
            if ($msgType == 'text') {
                $requestTxt = $event['message']['text'];
                $replyToken = $event['replyToken'];
                $message = new TextMessage(['type' => 'text', 'text' => 'สวัสดีครับคนไม่รู้จัก!']);
                ### Create Profile User ###
                $userId = $messagingApi->getProfile($event['source']['userId']);
                if ($userId) {
                    $profile = LineUser::updateOrcreate(['user_id' => $userId['userId']], [
                        'display_name' => $userId['displayName'],
                        'picture_url' => $userId['pictureUrl'],
                        'status_message' => $userId['statusMessage'],
                        'language' => $userId['language'],
                    ]);
                    ######### Step 1 #########
                    // Log::info($profile);
                    $lineMsg = LineBot::where('handle_date', now())->where('line_user_id', $profile->id)->count();
                    $txtMsg = "สวัสดีครับ !";
                    ####### Step. 2 Reply Message ########
                    $message = new TextMessage([
                        'type' => 'text',
                        'text' => $txtMsg . "คุณ" . $profile->display_name . "\nใช่หรือไม่",
                        'quickReply' => [
                            "items" => [
                                [
                                    "type" => "action",
                                    // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                    "action" => [
                                        "type" => "message",
                                        "label" => "ใช่",
                                        "text" => "Yes"
                                    ]
                                ],
                                [
                                    "type" => "action",
                                    // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                    "action" => [
                                        "type" => "message",
                                        "label" => "ไม่! ขอบคุณ",
                                        "text" => "No"
                                    ]
                                ]
                            ]
                        ]
                    ]);
                    ############ Create Chat History ##############
                    $lineReply = LineBot::create([
                        'handle_date' => now(),
                        'line_user_id' => $profile->id,
                        'message_source' => $event['source']['type'],
                        'message_type' => $msgType,
                        'message' => $requestTxt,
                        'reply_token' => $replyToken,
                        'is_replyed' => false
                    ]);

                    // // if ($event['source']['type'] == 'group') {
                    //     'type' => 'group',
                    //     'groupId' => 'C2d998b3e5f3edcd2b388c1eae277fd91',
                    //     'userId' => 'U25a9314f7c1de4ac983b70fbf8bb5072',
                    // // }
                }
                ###########################
                Log::info($requestTxt);
                $isReply = true;
                switch (Str::lower($requestTxt)) {
                    case "yes":
                    case "bot":
                        $message = new TextMessage([
                            'type' => 'text',
                            'text' => "คุณ" . $profile->display_name . "\nกรูณาเลือกรายการช่วยเหลือ",
                            "quickReply" => [
                                "items" => [
                                    [
                                        "type" => "action",
                                        // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                        "action" => [
                                            "type" => "message",
                                            "label" => "อัพเดท Stock",
                                            "text" => "UpdateStock"
                                        ]
                                    ],
                                    [
                                        "type" => "action",
                                        // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                        "action" => [
                                            "type" => "message",
                                            "label" => "ไม่! ขอบคุณ",
                                            "text" => "No"
                                        ]
                                    ]
                                ]
                            ]
                        ]);
                        break;
                    case 'no':
                        $message = new TextMessage([
                            'type' => 'text',
                            'text' => "งั้นขอจบบทสนทนาเพียงแค่นี้\nสบายดีคุณ " . $profile->display_name . "",
                        ]);
                        break;
                    case 'updatestock':
                        $message = new TextMessage([
                            'type' => 'text',
                            'text' => "คุณ" . $profile->display_name . "\nกรูณาเลือกคลังด้วย",
                            "quickReply" => [
                                "items" => [
                                    [
                                        "type" => "action",
                                        // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                        "action" => [
                                            "type" => "message",
                                            "label" => "คลัง 001",
                                            "text" => "001"
                                        ]
                                    ],
                                    [
                                        "type" => "action",
                                        // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                        "action" => [
                                            "type" => "message",
                                            "label" => "คลัง 002",
                                            "text" => "002"
                                        ]
                                    ],
                                    [
                                        "type" => "action",
                                        // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                        "action" => [
                                            "type" => "message",
                                            "label" => "คลัง 003",
                                            "text" => "003"
                                        ]
                                    ],
                                    [
                                        "type" => "action",
                                        // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                        "action" => [
                                            "type" => "message",
                                            "label" => "คลัง 005",
                                            "text" => "005"
                                        ]
                                    ],
                                    [
                                        "type" => "action",
                                        // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                        "action" => [
                                            "type" => "message",
                                            "label" => "คลัง 008",
                                            "text" => "008"
                                        ]
                                    ],
                                    [
                                        "type" => "action",
                                        // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                        "action" => [
                                            "type" => "message",
                                            "label" => "คลัง 011",
                                            "text" => "011"
                                        ]
                                    ],
                                    [
                                        "type" => "action",
                                        // "imageUrl" => "https://www.cryptologos.cc/logos/tron-trx-logo.png",
                                        "action" => [
                                            "type" => "message",
                                            "label" => "คลัง 400",
                                            "text" => "400"
                                        ]
                                    ]
                                ]
                            ]
                        ]);
                        break;
                    case "001":
                    case "002":
                    case "003":
                    case "005":
                    case "008":
                    case "011":
                    case "400":
                        #### Call Thread #####
                        try {
                            $result = Process::run('cd ..&&php artisan update:stock ' . $requestTxt . '');
                            if ($result->successful()) {
                                $message = new TextMessage([
                                    'type' => 'text',
                                    'text' => "คุณ " . $profile->display_name . "\nขณะนี้ระบบ ทำการอัพเดทคลัง " . $requestTxt . "\nเรียบร้อยแล้ว",
                                ]);
                            }

                            //                             $result->successful();
                            // $result->failed();
                            // $result->exitCode();
                            // $result->output();
                            // $result->errorOutput();
                        } catch (\Exception $e) {
                            Log::error($e->getMessage());
                        }
                        break;
                    default:
                        $isReply = false;
                        break;
                }

                $request = new ReplyMessageRequest([
                    'replyToken' => $replyToken,
                    'messages' => [$message],
                ]);
                if ($isReply) {
                    $response = $messagingApi->replyMessage($request);
                    $lineReply->is_replyed = true;
                    $lineReply->save();
                }
            }
        }
        // {
        //     "destination": "U7fbcd1983fdf6423d4c413ee8bd15900",
        //     "events": [
        //         {
        //             "type": "message",
        //             "message": {
        //                 "type": "text",
        //                 "id": "555766792450998910",
        //                 "quoteToken": "kMCrk-EOJ4IV5fpu3xGAIEksE66oFkHxcuO3TtV9xyTBodgZBcsAnVJaFk-Iz-jhaHkh_QieXkBW_iQbXwoyPY5AZY_BcsneKlkMla1cg7JxTbuiwGZDEgrn9JmlOUHqi4ks_CvtZRYdS312O7Mz8w",
        //                 "text": "hello"
        //             },
        //             "webhookEventId": "01JRA1RRDC9E660VJPJE5MSM7Z",
        //             "deliveryContext": {
        //                 "isRedelivery": false
        //             },
        //             "timestamp": 1744094126436,
        //             "source": {
        //                 "type": "user",
        //                 "userId": "U25a9314f7c1de4ac983b70fbf8bb5072"
        //             },
        //             "replyToken": "df957e867c464de9993e9ca254be902a",
        //             "mode": "active"
        //         }
        //     ]
        // }
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(LineBot $lineBot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LineBot $lineBot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LineBot $lineBot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LineBot $lineBot)
    {
        //
    }
}
