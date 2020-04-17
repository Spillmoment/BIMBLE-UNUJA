<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kursus;
use App\Kategori;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $kursus = Kursus::orderBy('created_at', 'DESC')->paginate(4);
        $kategori = Kategori::latest()->get();


        $keyword = $request->get('keyword');
        $filter_kategori = $request->get('nama_kategori');
        $nama_kategori = '';

        if ($keyword) {
            $kursus = Kursus::where('nama_kursus', 'LIKE', "%$keyword%")
                ->paginate(4);
        }

        if ($filter_kategori) {
            $kursus = Kursus::where('id_kategori', $filter_kategori)
                ->orderBy('created_at', 'DESC')
                ->paginate(4);

            $data_kategori = Kategori::findOrFail($filter_kategori);
            $nama_kategori = $data_kategori->nama_kategori;
        }

        return view('web.web_home', compact('kursus', 'kategori', 'nama_kategori'));
    }
}
