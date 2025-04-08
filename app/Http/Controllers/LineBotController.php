<?php

namespace App\Http\Controllers;

use App\Customs\GetUserLineProfile;
use App\Models\LineBot;
use App\Models\LineUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;
use LINE\Clients\MessagingApi\Model\UserProfileResponse;

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
        Log::info($request);
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
                $userId = $messagingApi->getProfile($event['source']['userId']);
                ### Create Profile User ###
                $profile = LineUser::updateOrcreate(['user_id' => $userId['userId']], [
                    'display_name' => $userId['displayName'],
                    'picture_url' => $userId['pictureUrl'],
                    'status_message' => $userId['statusMessage'],
                    'language' => $userId['language'],
                ]);
                ###########################
                $replyToken = $event['replyToken'];
                $message = new TextMessage(['type' => 'text', 'text' => 'สวัสดีครับคนไม่รู้จัก!']);
                if ($profile) {
                    $message = new TextMessage(['type' => 'text', 'text' => 'สวัสดีครับ ! ' . $profile->display_name]);
                }
                $request = new ReplyMessageRequest([
                    'replyToken' => $replyToken,
                    'messages' => [$message],
                ]);
                $response = $messagingApi->replyMessage($request);
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
