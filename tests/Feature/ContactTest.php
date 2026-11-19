<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Mail\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use WithFaker;

    #[Test]
    public function get_page_contact_should_return_200(): void
    {
        $response = $this->get(route('contact'));
        $response->assertOk();
    }

    #[Test]
    public function post_page_contact_should_return_302(): void
    {
        Mail::fake();
        $response = $this->post(route('contact.send'), [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'subject' => $this->faker->jobTitle(),
            'content' => $this->faker->paragraphs(3, true),
        ]);
        $response->assertFound();
        Mail::assertQueued(Contact::class);
    }

    #[Test]
    public function precognitive_validation_does_not_consume_contact_submission_limit(): void
    {
        Mail::fake();
        $data = ['email' => 'contact@example.com', 'content' => 'Hello'];

        for ($i = 0; $i < 6; $i++) {
            $this->withHeaders(['Precognition' => 'true'])
                ->post(route('contact.send'), $data)->assertNoContent();
        }

        $this->flushHeaders();
        $this->post(route('contact.send'), $data)->assertFound();
        Mail::assertQueued(Contact::class, 1);
    }

    #[Test]
    public function contact_message_length_is_limited(): void
    {
        Mail::fake();
        $data = ['email' => 'contact@example.com', 'content' => str_repeat('a', 10001)];

        $this->post(route('contact.send'), $data)->assertSessionHasErrors('content');
        Mail::assertNothingOutgoing();
    }
}
