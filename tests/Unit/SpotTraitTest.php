<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Http\Controllers\SpotTrait;
use PHPUnit\Framework\TestCase;

class SpotTraitTest extends TestCase
{
    use SpotTrait;

    public function test_calcul_note_for_wind(): void
    {
        $this->assertEquals(1, $this->calculNoteForWind(230, 230, 20));
        $this->assertEquals(-1, $this->calculNoteForWind(230, 50, 20));
    }
}
