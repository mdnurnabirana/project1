<?php

namespace App\Helper;

use App\Models\EmailConfiguration;

class MailHelper
{
    public static function setMailConfig()
    {
        $emailConfig = EmailConfiguration::first();
        $config = [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => $emailConfig->host,
            'port' => $emailConfig->port,
            'encryption' => $emailConfig->encryption,
            'username' => $emailConfig->username,
            'password' => $emailConfig->password,
            'timeout' => null,
            'local_domain' => config('app.url'),
         ];

        config(['mail.mailers.smtp' => $config]);
        config(['mail.from.address' => $emailConfig->email, 'mail.from.name' => 'IzyBuy']);
    }
}