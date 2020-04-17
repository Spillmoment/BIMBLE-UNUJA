<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = 'M Hafidz Masruri';
        return view('admin.dashboard.index', compact('user'));
    }
}
