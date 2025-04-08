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
}
