<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MissingMailToNearestDistrict extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $missingName;
    public $missingAge;
    public $missingContact;
    public $missingDate;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($missingInfo)
    {
       // dd($missingInfo);
        $this->missingName=$missingInfo->missing_person_name;
        $this->missingAge=$missingInfo->missing_person_age;
        $this->missingContact=$missingInfo->contact_number;
        $this->missingDate=$missingInfo->missing_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sendMailToUpazila')->subject('New Missing Add Your District');
    }
}
