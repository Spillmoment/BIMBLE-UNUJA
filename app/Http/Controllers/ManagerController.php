<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Tutor;
use App\Pendaftar;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:manager');
    }

    public function index()
    {
        return view(
            'admin.dashboard.index',
            [
                'kursus' => Kursus::count(),
                'pendaftar' => Pendaftar::count()
            ]
        );
    }
}
