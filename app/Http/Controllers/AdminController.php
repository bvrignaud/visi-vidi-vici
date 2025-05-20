<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function users(): \Inertia\Response
    {
        return Inertia::render('admin/Users', [
            'users' => User::all(),
        ]);
    }
}
