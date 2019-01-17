<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ServiceOrderEnd extends Mailable
{
    use Queueable, SerializesModels;
    public $service_order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $service_order)
    {
        $this->service_order = $service_order;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => 'no-reply@eeo.com.mx', 'name' => 'Notification'])
                    ->markdown('notifications.serviceOrderEnd')
                    ->subject('Hardware Service Desk');
    }
}
