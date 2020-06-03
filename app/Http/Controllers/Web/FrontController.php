<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kursus;
use App\Kategori;
use App\OrderDetail;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $kursus = Kursus::with(['kategori', 'tutor'])->orderBy('created_at', 'DESC')->paginate(4);
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
        }

        return view('web.web_home', compact('kursus', 'kategori', 'nama_kategori'));
    }


    public function kursus(Request $request)
    {
        $kursus = Kursus::with(['kategori', 'tutor'])->orderBy('created_at', 'DESC')->paginate(9);
        $kategori = Kategori::latest()->get();

        $keyword = $request->get('keyword');
        $filter_kategori = $request->get('nama_kategori');

        if ($keyword) {
            $kursus = Kursus::with(['kategori', 'tutor'])
                ->where('nama_kursus', 'LIKE', "%$keyword%")
                ->orderBy('created_at', 'DESC')
                ->paginate(9);
        }

        if ($filter_kategori) {
            $kursus = Kursus::with('kategori')
                ->where('id_kategori', 'LIKE', "%$filter_kategori%")
                ->orderBy('created_at', 'DESC')
                ->paginate(3);

            $data_kategori = Kategori::findOrFail($filter_kategori);
            $nama_kategori = $data_kategori->nama_kategori;
        }

        return view('web.web_kursus', compact('kursus', 'kategori'));
    }

    public function show($slug)
    {
        $pendaftarId = Auth::id();
        $kursus = Kursus::with(['galleries'])
            ->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::latest()->get();

        $check_kursus_status = OrderDetail::where('id_pendaftar', $pendaftarId)
            ->where('id_kursus', $kursus->id)
            ->where(function ($query) {
                $query->where('status', 'PROCESS')
                    ->orWhere('status', 'CANCEL')
                    ->orWhere('status', 'PENDING')
                    ->orWhere('status', 'FAILED');
            })
            ->first();
        $check_kursus_sukses = OrderDetail::where('id_pendaftar', $pendaftarId)
            ->where('id_kursus', $kursus->id)
            ->where('status', 'SUCCESS')
            ->first();
        return view('web.web_detail_kursus', [
            'kursus' => $kursus,
            'kategori' => $kategori,
            'check_kursus' => $check_kursus_status,
            'check_kursus_sukses' => $check_kursus_sukses,
        ]);
    }
}
