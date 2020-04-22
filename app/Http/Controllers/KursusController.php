<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Http\Requests\KursusRequest;
use App\Kategori;
use App\Tutor;
use Illuminate\Support\Facades\Storage;

class KursusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $kursus = Kursus::orderBy('created_at', 'DESC')->paginate(10);
        $kategori = Kategori::orderBy('created_at', 'DESC')->paginate(10);


        $keyword = $request->get('keyword');
        $filter_kategori = $request->get('nama_kategori');

        if ($keyword) {
            $kursus = Kursus::with(['kategori', 'tutor'])
                ->where('nama_kursus', 'LIKE', "%$keyword%")
                ->paginate(10);
        } else {
            $kursus = Kursus::orderBy('created_at', 'DESC')->paginate(10);
        }

        if ($filter_kategori) {
            $kursus = Kursus::with(['kategori', 'tutor'])
                ->where('id_kategori', 'LIKE', "%$filter_kategori%")
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }


        return view('admin.kursus.index', compact('kursus', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $tutor = Tutor::all();
        return view('admin.kursus.create', compact('kategori', 'tutor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KursusRequest $request)
    {
        $kursus = $request->all();

        if ($request->file('gambar_kursus')) {
            $file = $request->file('gambar_kursus')->store('kursus', 'public');
            $kursus['gambar_kursus'] = $file;
        }

        Kursus::create($kursus);

        return redirect()->route('kursus.index')->with(['status' => 'Data Kursus Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $kursus = Kursus::findOrFail($id);
        return view('admin.kursus.show', compact('kursus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kursus = Kursus::findOrFail($id);
        $kategori = Kategori::all();
        $tutor = Tutor::all();
        return view('admin.kursus.edit', compact('kursus', 'kategori', 'tutor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KursusRequest $request, $id)
    {
        $kursus = Kursus::findOrFail($id);
        $kursus->nama_kursus = $request->get('nama_kursus');
        $kursus->id_kategori = $request->get('id_kategori');
        $kursus->id_tutor = $request->get('id_tutor');
        $kursus->biaya_kursus = $request->get('biaya_kursus');
        $kursus->lama_kursus = $request->get('lama_kursus');
        $kursus->diskon_kursus = $request->get('diskon_kursus');
        $kursus->latitude = $request->get('latitude');
        $kursus->longitude = $request->get('longitude');

        if ($kursus->gambar_kursus && file_exists(storage_path('app/public/' . $kursus->gambar_kursus))) {
            Storage::delete('public/' . $kursus->gambar_kursus);
            $file = $request->file('gambar_kursus')->store('kursus', 'public');
            $kursus->gambar_kursus = $file;
        }

        $kursus->save();
        return redirect()->route('kursus.index')->with(['status' => 'Data Kursus Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kursus = Kursus::findOrFail($id);
        Storage::delete('public/' . $kursus->gambar_kursus);
        $kursus->delete();

        return redirect()->route('kursus.index')->with(['status' => 'Data Kursus Berhasil Dihapus']);
    }

    public function trash(Request $request)
    {
        $filter_trash = $request->get('trash');

        if ($filter_trash) {
            $kursus = Kursus::onlyTrashed()->where('nama_kursus', 'LIKE', "%$filter_trash%")
                ->paginate(10);
        } else {
            $kursus = Kursus::onlyTrashed()->paginate(10);
        }

        return view('admin.kursus.trash', compact('kursus'));
    }

    public function restore($id)
    {
        $kursus = Kursus::withTrashed()->findOrFail($id);

        if ($kursus->trashed()) {
            $kursus->restore();
        } else {
            return redirect()->route('kursus.index')
                ->with(['status' => 'kursus tidak ada di Trash']);
        }
        return redirect()->route('kursus.index')
            ->with(['status' => 'kursus Sukses Dikembalikan']);
    }

    public function deletePermanent($id)
    {
        $kursus = Kursus::withTrashed()->findOrFail($id);
        if (!$kursus->trashed()) {
            return redirect()->route('kursus.trash')
                ->with('status', 'Tidak bisa menghapus permanent data kursus yang aktif');
        } else {
            $kursus->forceDelete();
            return redirect()->route('kursus.trash')
                ->with('status', 'Data kursus berhasil dihapus permanent');
        }
    }
}
