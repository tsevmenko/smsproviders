<?php

namespace App\Listeners\SMSProviders;

use App\Events\UserResetPasswordEvent;
use App\Support\Helpers\UserHelper;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Support\Facades\Log;

class SMSSecondProvider extends SMSProviderAbstract
{
    public function __construct(
        protected array $supportedCodes = ['REMIND', 'REGISTER'],
        protected array $supportedGeos = ['KZ'])
    {
    }

    public function handle(UserResetPasswordEvent $event): void
    {
        $this->logRequest($event);

        if (in_array($event->messageDTO->messageSettings->code, $this->supportedCodes)
            && in_array($event->messageDTO->receiver->country, $this->supportedGeos)) {
            // usefull logic here with code and text
            $code = 200;
            $responseText = 'message sent';
            $this->logResponse([
                UserHelper::maskPhoneNumber($event->messageDTO->receiver->phoneNumber),
                'Response code: ' . $code,
                'Response text: ' . $responseText
            ]);
        }
    }
}
