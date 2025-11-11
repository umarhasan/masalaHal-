<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class LeadGeneratedMail extends Mailable
{
    use SerializesModels;

    public $user;
    public $password;
    public $leadData;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $password
     * @param $leadData
     */
    public function __construct($user, $password, $leadData)
    {
        $this->user = $user;
        $this->password = $password;
        $this->leadData = $leadData;
    }


    public function build()
    {
        return $this->view('emails.lead_generated')
                    ->with([
                        'userName' => $this->user->name,
                        'userEmail' => $this->user->email,
                        'password' => $this->password,
                        'leadData' => $this->leadData
                    ]);
    }
}

