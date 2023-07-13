<?php

namespace App\Events;

use App\Support\DTO\MessageDTO;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserResetPasswordEvent implements ShouldBroadcast
{
    public function __construct(public MessageDTO $messageDTO) {
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel("sms");
    }

    public function broadcastAs(): string
    {
        // we could add id detail here
        return 'SMSEventType';
    }

    // for the correct serialization
    public function broadcastWith(): array
    {
        return [
            'userPhone' => $this->messageDTO->receiver->phoneNumber,
            'userCountry' => $this->messageDTO->receiver->country,
            'messageCode' => $this->messageDTO->messageSettings->code,
            'messageTemplate' => $this->messageDTO->messageSettings->messageTemplate,
            'messageTransportType' => $this->messageDTO->messageSettings->transportType,
        ];
    }
}
