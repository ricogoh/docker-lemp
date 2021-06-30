<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // render mail
        return (new TestMail())->render();


        // Queue function for mail
        $alert_time = now()->addMinutes(5);
        $email = 'rico@sage42.net';
        return Mail::to($email)->later(now()->addMinutes(10), (new TestMail())->onQueue('case'));
    }
}
