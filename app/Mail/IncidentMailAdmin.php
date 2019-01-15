<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncidentMailAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $incident, $asset, $user , $user_admin_incident;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $incident, $asset, $user, $user_admin_incident)
    {
        $this->incident = $incident;
        $this->asset = $asset;
        $this->user = $user;
        $this->user_admin_incident = $user_admin_incident;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => 'no-reply@eeo.com.mx', 'name' => 'Notification'])
                    ->markdown('notifications.incidentMailAdmin')
                    ->subject('Hardware Service Desk');
    }
}
