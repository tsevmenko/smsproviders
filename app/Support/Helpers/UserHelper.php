<?php

namespace App\Support\Helpers;


class UserHelper
{
    public static function maskPhoneNumber(string $phoneNumber) {
        return substr_replace(
            $phoneNumber,
            str_repeat('*', strlen($phoneNumber) - 4),
            0,
            -4
        );
    }
}
