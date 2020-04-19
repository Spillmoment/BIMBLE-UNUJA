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


        if ($filter_kategori != '' || $keyword != '') {

            $kursus = Kursus::with('kategori')
                ->whereHas('kategori', function ($query) use ($keyword) {
                    $query->where('nama_kursus', 'LIKE', "%$keyword%");
                })
                ->where('id_kategori', 'LIKE', "%$filter_kategori%")
                ->orderBy('created_at', 'DESC')
                ->paginate(4);

            $data_kategori = Kategori::findOrFail($filter_kategori);
            $nama_kategori = $data_kategori->nama_kategori;
        } else {
            $kursus = Kursus::orderBy('created_at', 'DESC')->paginate(4);
        }

        return view('web.web_home', compact('kursus', 'kategori', 'nama_kategori'));
    }
}
