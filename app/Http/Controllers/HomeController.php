<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Spot;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Home', [
            'spots' => Spot::orderBy('name')->get(),
        ]);
    }
}
