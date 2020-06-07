<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Http\Requests\KategoriRequest;

class KategoriController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $kategori = Kategori::orderBy('created_at', 'DESC')->paginate(10);
        $filterKeyword = $request->get('keyword');
        $status = $request->get('status');

        if ($status) {
            $kategori = Kategori::where('status', $status)
                ->paginate(10);
        } else {
            $kategori = Kategori::orderBy('created_at', 'DESC')->paginate(10);
        }

        if ($filterKeyword) {
            if ($status) {
                $kategori = Kategori::where('nama_kategori', 'LIKE', "%$filterKeyword%")
                    ->where('status', $status)
                    ->paginate(10);
            } else {
                $kategori = Kategori::where('nama_kategori', 'LIKE', "%$filterKeyword%")
                    ->paginate(10);
            }
        }

        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {
        Kategori::create($request->all());

        return redirect()->route('kategori.index')
            ->with(['status' => 'Data Kategori Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->get('nama_kategori');
        $kategori->keterangan = $request->get('keterangan');

        $kategori->save();
        return redirect()->route('kategori.index')->with(['status' => 'Data Kategori Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with(['status'  => 'Data Kategori Berhasil Dimasukkan Ke Trash']);
    }

    public function trash(Request $request)
    {
        $filter_trash = $request->get('trash');

        if ($filter_trash) {
            $kategori = Kategori::onlyTrashed()->where('nama_kategori', 'LIKE', "%$filter_trash%")
                ->paginate(10);
        } else {
            $kategori = Kategori::onlyTrashed()->paginate(10);
        }

        return view('admin.kategori.trash', compact('kategori'));
    }

    public function restore($id)
    {
        $kategori = Kategori::withTrashed()->findOrFail($id);

        if ($kategori->trashed()) {
            $kategori->restore();
        } else {
            return redirect()->route('kategori.index')
                ->with(['status' => 'Kategori tidak ada di Trash']);
        }
        return redirect()->route('kategori.index')
            ->with(['status' => 'Kategori Sukses Dikembalikan']);
    }

    public function deletePermanent($id)
    {
        $kategori = Kategori::withTrashed()->findOrFail($id);
        if (!$kategori->trashed()) {
            return redirect()->route('kategori.index')
                ->with('status', 'Can not delete permanent active kate$kategori');
        } else {
            $kategori->forceDelete();
            return redirect()->route('kategori.index')
                ->with('status', 'Category permanently deleted');
        }
    }
}
