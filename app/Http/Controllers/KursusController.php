<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kursus;
use App\Http\Requests\KursusRequest;
use App\Kategori;
use App\Gallery;
use App\Tutor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $nama_kursus = $kursus['nama_kursus'];

        $kursus['slug'] = Str::slug($nama_kursus, '-');
        $kursus['gambar_kursus'] = $request->file('gambar_kursus')->store('kursus', 'public');

        Kursus::create($kursus);
        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Ditambahkan']);
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
        $data = $request->all();

        $nama_kursus = $data['nama_kursus'];
        $data['slug'] = Str::slug($nama_kursus, '-');

        if ($request->hasFile('gambar_kursus')) {
            if ($request->file('gambar_kursus')) {
                if ($kursus->gambar_kursus && file_exists(storage_path('app/public/' . $kursus->gambar_kursus))) {
                    Storage::delete('public/' . $kursus->gambar_kursus);
                    $file = $request->file('image')->store('gallery', 'public');
                    $data['image'] = $file;
                }
            }
        }

        $kursus->update($data);
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
        File::delete('uploads/kursus/' . $kursus->gambar_kursus);
        $kursus->delete();


        return redirect()->route('kursus.index')
            ->with(['status' => 'Data Kursus Berhasil Dihapus']);
    }

    public function gallery($id)
    {
        $kursus = Kursus::with('galleries')
            ->findorFail($id);

        $gallery = Gallery::with('kursus')
            ->where('kursus_id', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(9);

        return view('admin.kursus.gallery')->with([
            'kursus' => $kursus,
            'items' => $gallery
        ]);
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
