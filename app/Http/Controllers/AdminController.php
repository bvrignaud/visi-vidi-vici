<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function users(): Response
    {
        return Inertia::render('admin/Users', [
            'users' => User::all(),
        ]);
    }
}
