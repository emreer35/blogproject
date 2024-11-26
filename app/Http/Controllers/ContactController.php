<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'content' => 'required|min:30'
        ]);
        $contact = new Contact(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]
        );

        Mail::to('emreer3509@gmail.com')->send(new ContactMail($contact));
        return back()->with('success', 'İletiniz Başarıyla Gönderildi.');
    }
}
