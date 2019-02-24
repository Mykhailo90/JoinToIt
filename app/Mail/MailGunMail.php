<?php

namespace App\Mail;

use App\Company;
use Illuminate\Mail\Mailable;

class MailGunMail extends Mailable
{
    const X_MAILGUN_TAG_HEADER = 'X-Mailgun-Tag';
    const X_MAILGUN_VARIABLES_HEADER = 'X-Mailgun-Variables';

    protected function addHeadersToEmail(Company $company = null)
    {
        $this->withSwiftMessage(function ($message) use ($company) {
            $headers = $message->getHeaders();
            $headers->addTextHeader(self::X_MAILGUN_TAG_HEADER, class_basename($this));
            $headers->addTextHeader(self::X_MAILGUN_VARIABLES_HEADER, json_encode([
                "email_id" => uniqid(),
                'compnany_id' => isset($company) ? $company->id : null
            ]));
        });
        return $this;
    }
}