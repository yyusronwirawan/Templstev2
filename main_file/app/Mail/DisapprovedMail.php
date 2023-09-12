<?php

namespace App\Mail;

use App\Models\RequestDomain;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DisapprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RequestDomain $domain_details)
    {
        $this->domain_details = $domain_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
{        return $this->markdown('requestdomain.maildisapprove')->with('domain_details',$this->domain_details)->subject('Domain Unverified');
    }
}
