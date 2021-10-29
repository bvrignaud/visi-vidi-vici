<?php

namespace Tests\Feature;

class HomeTest extends AbstractFeatureTestCase
{
    public function test_index_should_return_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
