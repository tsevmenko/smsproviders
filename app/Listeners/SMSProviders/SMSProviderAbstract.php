<?php

namespace App\Listeners\SMSProviders;

use App\Events\UserResetPasswordEvent;
use App\Support\Helpers\UserHelper;
use Illuminate\Support\Facades\Log;

abstract class SMSProviderAbstract
{
    protected array $supportedCodes = [];
    protected array $supportedGeos = [];

    public abstract function handle(UserResetPasswordEvent $event): void;

    public function logRequest(UserResetPasswordEvent $event)
    {
        Log::info('[SMSRequest]', [
            'userPhone' => UserHelper::maskPhoneNumber($event->messageDTO->receiver->phoneNumber),
            'userCountry' => $event->messageDTO->receiver->country,
            'messageCode' => $event->messageDTO->messageSettings->code,
            'messageTemplate' => $event->messageDTO->messageSettings->messageTemplate,
            'messageTransportType' => $event->messageDTO->messageSettings->transportType,
        ]);
    }

    public function logResponse(array $response)
    {
        Log::info('[SMSResponse]', (array)implode("\r\n", $response));
    }
}
