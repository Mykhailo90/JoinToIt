<?php

namespace App\Notifications;

use App\Company;
use App\Mail\CreateNewCompanyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class CreateCompanyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $company;
    public $message;

    /** Create a new notification instance.
     *
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
        $this->message = $this->getSmsMessageText();
    }

    /** Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $viaChannels = [];

        if ($notifiable->email) {
            $viaChannels[] = 'mail';
        }

        return $viaChannels;
    }

    /** Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return CreateNewCompanyMail
     */
    public function toMail($notifiable)
    {
        return new CreateNewCompanyMail($this->company);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    private function getSmsMessageText()
    {
        return 'Company was create successfully';
    }
}