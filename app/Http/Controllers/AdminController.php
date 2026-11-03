<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the Admin Calendar Dashboard view based on calendar.html and DESIGN (1).md.
     */
    public function index(): View
    {
        $admin = Auth::user();

        return view('admin.calendar', [
            'admin' => $admin,
        ]);
    }
}
