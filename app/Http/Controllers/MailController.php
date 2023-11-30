<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;
use Symfony\Component\HttpFoundation\Response;


class MailController extends Controller {
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function sendEmail() {

        

        Mail::to($this->details['receptor'])->queue(new \App\Mail\Email($this->details));

        return response()->json([
            'message' => 'Email has been sent.'
        ], Response::HTTP_OK);
    }

}


