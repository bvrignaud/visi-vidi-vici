<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Contact');
    }

    public function send(ContactRequest $request): RedirectResponse
    {
        Mail::to(config('mail.contact.address'))
            ->send(new Contact($request->validated()));

        return back()->with('message_sent', 'Votre message vient d\'être envoyé');
    }
}
