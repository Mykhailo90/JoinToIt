<?php

namespace App\Mail;

use App\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class CreateNewCompanyMail extends MailGunMail
{
    use Queueable, SerializesModels;

    private $company;

    /** Create a new message instance.
     *
     * @param Company $company
     *
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /** Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = $this->company;
        $from = env('ADMIN_EMAIL');

        $mail = $this->view("mail.createCompanyMail")
            ->to($company->email)
            ->from($from)
            ->subject("Your company added successfully")
            ->with(['company' => $company])
            ->addHeadersToEmail($company);

        return $mail;
    }
}