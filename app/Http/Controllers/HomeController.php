<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Spot;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', [
            'spots' => Inertia::defer(fn () => Spot::orderBy('name')->get()),
        ]);
    }
}
