<?php

namespace App\Helper;

use App\Models\EmailConfigSetting;

class MailHelper
{
    public static function setMailConfig()
    {
        $email_config = EmailConfigSetting::first();

        $config = [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => $email_config->mail_host,
            'port' => $email_config->mail_port,
            'encryption' => $email_config->mail_encryption,
            'username' => $email_config->username_smtp,
            'password' => $email_config->password_smtp,
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ];

        config(['mail.mailers.smtp' => $config]);
        config(['mail.from.address' => $email_config->email]);
    }
}
