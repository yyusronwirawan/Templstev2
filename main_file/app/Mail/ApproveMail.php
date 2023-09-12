<?php

namespace App\Mail;

use App\Models\RequestDomain;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $domain_details;
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
    {
        //return $this->markdown('requestdomain.mailapprove')->subject('Mail send for testing purpose.');
        return $this->markdown('requestdomain.mailapprove')->with('domain_details',$this->domain_details)->subject('Domain Verified');
    }
}
