<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request): void
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:200',
            'email' => 'email|required',
            'subject' => 'nullable|string|max:255',
            'content' => 'string',
        ]);

        Mail::to(config('mail.contact.address'))->send(new Contact($validated));
    }
}
