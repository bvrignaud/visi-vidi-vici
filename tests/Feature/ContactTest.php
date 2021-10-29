<?php

namespace Tests\Feature;

use App\Mail\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use WithFaker;

    public function testGetPageContactShouldReturn_200(): void
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(200);
    }

    public function testPostPageContactShouldReturn_302(): void
    {
        Mail::fake();
        $response = $this->post(route('contact.send'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'subject' => $this->faker->jobTitle,
            'content' => $this->faker->paragraphs(3, true),
        ]);
        $response->assertStatus(302);
        Mail::assertQueued(Contact::class);
    }
}
