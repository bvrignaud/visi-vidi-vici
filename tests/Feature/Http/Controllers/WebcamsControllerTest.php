<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class WebcamsControllerTest extends TestCase
{
    /** @test */
    public function get_webcams_should_return_200(): void
    {
        $response = $this->get('/webcams');

        $response->assertStatus(200);
    }
}
