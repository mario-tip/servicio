<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderServiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $orderService;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => 'no-reply@eeo.com.mx', 'name' => 'Notification'])
                    ->markdown('notifications.sendEmail');
    }
}
