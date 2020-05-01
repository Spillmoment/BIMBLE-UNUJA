<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kursus;
use App\Kategori;

class KursusController extends Controller
{
    public function show($slug){
        $kategori = Kategori::latest()->get();
        $kursus = Kursus::where('slug', $slug)->first();

        return view('web.web_detail_kursus', compact('kursus', 'kategori'));
    }
}
