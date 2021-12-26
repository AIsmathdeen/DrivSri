<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class certificatenotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($certificate)

    {
      //  dd($certificate);
        $this->certificate_details = $certificate;
     //dd( $this->certificate_details);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('info@whizchain.com', 'Sri Lanka Motor Traffic Police')->subject('Certificate of Merit')
        ->view('admin.license_holders.certificate_notification', ['certificate_data'=>$this->certificate_details]);
    }
}
