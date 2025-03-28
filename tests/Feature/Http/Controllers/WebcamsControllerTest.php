<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WebcamsControllerTest extends TestCase
{
    #[Test]
    public function get_webcams_should_return_200(): void
    {
        $response = $this->get('/webcams');

        $response->assertStatus(200);
    }
}
