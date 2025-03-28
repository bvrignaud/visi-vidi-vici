<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

abstract class AbstractFeatureTestCase extends \Tests\TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        //        $this->withoutExceptionHandling();
        Artisan::call('db:seed');
    }
}
