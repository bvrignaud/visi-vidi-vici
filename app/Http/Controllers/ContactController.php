<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Contact');
    }

    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:200',
            'email' => 'email|required',
            'subject' => 'nullable|string|max:255',
            'content' => 'string',
        ]);

        Mail::to(config('mail.contact.address'))->send(new Contact($validated));

        return back()->with('message_sent', 'Votre message vient d\'être envoyé');
    }
}
