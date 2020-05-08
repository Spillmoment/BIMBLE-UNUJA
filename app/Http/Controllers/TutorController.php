<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tutor;
use Illuminate\Support\Facades\File;

class TutorController extends Controller
{

    public function index()
    {
        $latestTutor = Tutor::latest()->get();
        return view('admin.tutor.index', ['tutor' => $latestTutor]);
    }


    public function create()
    {
        return view('admin.tutor.create');
    }


    public function store(Request $request)
    {
        $tutor = $request->all();

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $nama_gambar = 'tutor-' . time() . '.' . $foto->getClientOriginalExtension();
            $request->file('foto')->move('uploads/tutor', $nama_gambar);
            $tutor['foto'] = $nama_gambar;
        }

        Tutor::create($tutor);

        return redirect()->route('tutor.index')
            ->with(['status' => 'Data Tutor Berhasil Ditambahkan']);
    }


    public function show($id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('admin.tutor.show', compact('tutor'));
    }


    public function edit($id)
    {
        $tutor = Tutor::findOrFail($id);
        return view('admin.tutor.edit', compact('tutor'));
    }


    public function update(Request $request, $id)
    {
        $tutor = Tutor::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($request->file('foto')) {
                File::delete('uploads/tutor/' . $tutor->foto);
                $foto = $request->file('foto');
                $nama_gambar = 'tutor-' . time() . '.' . $foto->getClientOriginalExtension();
                $request->file('foto')->move('uploads/tutor', $nama_gambar);
                $data['foto'] = $nama_gambar;
            }
        }

        $tutor->update($data);
        return redirect()->route('tutor.index')
            ->with(['status' => 'Data Tutor Berhasil Di Update']);
    }


    public function destroy($id)
    {
        $tutor = Tutor::findOrFail($id);
        File::delete('uploads/tutor/' . $tutor->foto);
        $tutor->delete();


        return redirect()->route('tutor.index')
            ->with(['status' => 'Data Tutor Berhasil Dihapus']);
    }
}
