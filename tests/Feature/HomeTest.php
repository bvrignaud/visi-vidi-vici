<?php

namespace Tests\Feature;

class HomeTest extends AbstractFeatureTestCase
{
    public function test_the_home_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
