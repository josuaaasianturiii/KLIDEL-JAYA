<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the Gabe Medica Home / Dashboard view.
     */
    public function index(): View
    {
        $authUser = auth()->user();
        $user = [
            'name' => $authUser?->name ?? 'Rina Anggraini',
            'role' => $authUser ? ($authUser->isAdmin() ? 'Administrator' : 'Pasien') : 'Pasien',
            'initials' => $authUser ? strtoupper(substr($authUser->name, 0, 1).substr(trim(strstr($authUser->name, ' ') ?: ''), 0, 1)) : 'RA',
            'is_logged_in' => auth()->check(),
            'is_admin' => $authUser?->isAdmin() ?? false,
        ];

        $nextAppointment = [
            'doctor_name' => 'Dr. Saran Mitchell',
            'specialty' => 'Orthopedist',
            'date_time' => 'Aug 14, 2026 · 2:30 PM',
            'initials' => 'SM',
            'image' => 'images/doctors/doctor-3.png',
        ];

        $categories = [
            ['id' => 'all', 'name' => 'Semua'],
            ['id' => 'Cardiologist', 'name' => 'Heart'],
            ['id' => 'Neurologist', 'name' => 'Brain expert'],
            ['id' => 'Orthopedist', 'name' => 'Bone'],
        ];

        $doctors = [
            [
                'id' => 1,
                'name' => 'Dr. Lina Wijaya',
                'specialty' => 'Cardiologist',
                'category' => 'Cardiologist',
                'rating' => 4.9,
                'price' => '$16.5',
                'price_num' => 16.5,
                'initials' => 'LW',
                'image' => 'images/doctors/doctor-1.png',
                'availability' => '9AM - 8PM',
                'experience' => '10 years',
                'patients' => '3.8k Up',
            ],
            [
                'id' => 2,
                'name' => 'Dr. Anaya Kapoor',
                'specialty' => 'Neurologist',
                'category' => 'Neurologist',
                'rating' => 4.8,
                'price' => '$18.0',
                'price_num' => 18.0,
                'initials' => 'AK',
                'image' => 'images/doctors/doctor-2.png',
                'availability' => '8AM - 6PM',
                'experience' => '12 years',
                'patients' => '4.6k Up',
            ],
            [
                'id' => 3,
                'name' => 'Dr. Saran Mitchell',
                'specialty' => 'Orthopedist',
                'category' => 'Orthopedist',
                'rating' => 4.7,
                'price' => '$19.0',
                'price_num' => 19.0,
                'initials' => 'SM',
                'image' => 'images/doctors/doctor-3.png',
                'availability' => '10AM - 7PM',
                'experience' => '15 years',
                'patients' => '5.2k Up',
            ],
        ];

        return view('home', [
            'user' => $user,
            'nextAppointment' => $nextAppointment,
            'categories' => $categories,
            'doctors' => $doctors,
        ]);
    }

    /**
     * Display the Patient Calendar view.
     */
    public function calendar(): View
    {
        $authUser = auth()->user();
        $user = [
            'name' => $authUser?->name ?? 'Rina Anggraini',
            'email' => $authUser?->email ?? 'rina@example.com',
            'role' => $authUser ? ($authUser->isAdmin() ? 'Administrator' : 'Pasien') : 'Pasien',
            'initials' => $authUser ? strtoupper(substr($authUser->name, 0, 1).substr(trim(strstr($authUser->name, ' ') ?: ''), 0, 1)) : 'RA',
            'is_logged_in' => auth()->check(),
            'is_admin' => $authUser?->isAdmin() ?? false,
        ];

        return view('admin.calendar', [
            'user' => $user,
            'role' => 'patient',
        ]);
    }
}
