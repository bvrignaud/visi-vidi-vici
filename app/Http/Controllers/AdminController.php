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
        // Ensure only admins can access this page
        abort_if(! auth()->user()->is_admin, 403);

        return Inertia::render('admin/Users', [
            'users' => User::all(),
        ]);
    }
}
