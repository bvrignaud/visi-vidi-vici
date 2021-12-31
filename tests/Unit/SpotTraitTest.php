<?php

namespace Tests\Unit;

use App\Http\Controllers\SpotTrait;
use PHPUnit\Framework\TestCase;

class SpotTraitTest extends TestCase
{
    use SpotTrait;

    public function test_calculNoteForWind(): void
    {
        $this->assertEquals(1, $this->calculNoteForWind(230, 230));
        $this->assertEquals(-1, $this->calculNoteForWind(230, 50));
    }
}
