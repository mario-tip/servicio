<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class serviceOrder extends Mailable
{
    use Queueable, SerializesModels;
    // public $serviceOrder;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->serviceOrder=$orderService;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from(['address' => 'no-reply@eeo.com.mx', 'name' => 'Notification'])
                    ->text('notifications.sendEmail');
    }
}
