<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Tutor;
use App\Pendaftar;

class DashboardController extends Controller
{
    public function index()
    {
        return view(
            'admin.dashboard.index',
            [
                'kursus' => Kursus::count(),
                'tutor' => Tutor::count(),
                'pendaftar' => Pendaftar::count()
            ]
        );
    }
}
