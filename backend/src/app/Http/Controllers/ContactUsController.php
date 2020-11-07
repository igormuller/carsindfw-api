<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function contact(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'message' => 'required'
            ]
        );

        $emailSend = env('MAIL_SEND');
        Mail::to($emailSend)->send(new ContactUs($request->all()));
        return response('send email', 200);
    }
}
