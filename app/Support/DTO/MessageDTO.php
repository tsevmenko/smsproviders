<?php

namespace App\Support\DTO;


use App\Models\User;
use App\Models\MessageSettings;

class MessageDTO
{
    public function __construct(
        public ?User $receiver = null,
        public ?MessageSettings $messageSettings = null
    ) {
    }

    /*
     * Getters here
     * */
}
