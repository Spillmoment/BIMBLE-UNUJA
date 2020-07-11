<?php

namespace App\Http\Controllers;

use App\Http\Requests\TutorRequest;
use Illuminate\Http\Request;
use App\Tutor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class TutorController extends Controller
{

    public function index(Request $request)
    {
        $tutor = Tutor::orderBy('created_at', 'DESC')
            ->paginate(10);
        $keyword = $request->get('keyword');

        if ($keyword) {
            $tutor = Tutor::where('nama_tutor', 'LIKE', "%$keyword%")
                ->paginate(10);
        }

        return view('admin.tutor.index', [
            'tutor' => $tutor
        ]);
    }


    public function create()
    {
        return view('admin.tutor.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_tutor'            => 'required|min:3|max:100',
            'alamat'                => 'required|min:3|max:200',
            'email'                 => 'required|email|unique:tutor',
            'foto'                  => 'required|image|mimes:jpg,jpeg,png,bmp',
            'username'              => 'required|min:3|max:100|unique:tutor',
            'password'              => 'required|min:3',
            'konfirmasi_password'   => 'required|same:password|min:3',
            'keahlian'              => 'required',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $nama_gambar = 'tutor-' . time() . '.' . $foto->getClientOriginalExtension();
            $request->file('foto')->move('uploads/tutor', $nama_gambar);
            $data['foto'] = $nama_gambar;
        }

        Tutor::create($data);
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
        $request->validate([
            'nama_tutor'            => 'required|min:3|max:100',
            'alamat'                => 'required|min:3|max:200',
            'email'                 => 'required|email|unique:tutor,email,' . $id,
            'foto'                  => 'sometimes|nullable|image|mimes:jpg,jpeg,png,bmp',
            'username'              => 'required|min:3|max:100|unique:tutor,username,' . $id,
            'password'              => 'sometimes|nullable|min:3',
            'konfirmasi_password'   => 'sometimes|same:password|nullable|min:3',
            'keahlian'              => 'required',
        ]);

        $tutor = Tutor::findOrFail($id);
        $data = $request->all();

        if ($request->input('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }

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
        return redirect()->route('tutor.index')->with([
            'status' => 'Data Tutor Berhasil Di Update'
        ]);
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
