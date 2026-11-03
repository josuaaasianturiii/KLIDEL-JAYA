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
        $user = [
            'name' => $admin?->name ?? 'Amélie Laurent',
            'email' => $admin?->email ?? 'admin@gabemedica.com',
            'role' => 'Administrator',
            'initials' => $admin ? strtoupper(substr($admin->name, 0, 1).substr(trim(strstr($admin->name, ' ') ?: 'L'), 1, 1)) : 'AL',
            'is_logged_in' => true,
            'is_admin' => true,
        ];

        return view('admin.calendar', [
            'admin' => $admin,
            'user' => $user,
            'role' => 'admin',
        ]);
    }
}
