<?php

namespace App\Customs;

use Illuminate\Support\Facades\Log;

class GetUserLineProfile
{

    public string $profile;
    protected $userId;
    /**
     * Create a new class instance.
     */
    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        $client = new \GuzzleHttp\Client();
        $config = new \LINE\Clients\MessagingApi\Configuration();
        $config->setAccessToken(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $messagingApi = new \LINE\Clients\MessagingApi\Api\MessagingApiApi(
            client: $client,
            config: $config,
        );
    }
}
