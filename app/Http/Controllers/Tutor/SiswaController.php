<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Siswa;
use App\Http\Requests\SiswaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_tutor = Auth::id();
        $siswa = Siswa::where('id_tutor', $id_tutor)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('tutor.siswa.index', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutor.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiswaRequest $request)
    {
        $siswa = $request->all();
        $siswa['password'] = Hash::make($siswa['password']);

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $nama_gambar = 'siswa-' . time() . '.' . $foto->getClientOriginalExtension();
            $request->file('foto')->move('uploads/siswa', $nama_gambar);
            $siswa['foto'] = $nama_gambar;
        }

        Siswa::create($siswa);
        return redirect()->route('siswa.index')
            ->with(['status' => 'Data Tutor Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('tutor.siswa.show', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('tutor.siswa.edit', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiswaRequest $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $data =  $request->all();
        $data['password'] = Hash::make($data['password']);
        if ($request->hasFile('foto')) {
            if ($request->file('foto')) {
                File::delete('uploads/siswa/' . $siswa->foto);
                $foto = $request->file('foto');
                $nama_gambar = 'siswa-' . time() . '.' . $foto->getClientOriginalExtension();
                $request->file('foto')->move('uploads/siswa', $nama_gambar);
                $data['foto'] = $nama_gambar;
            }
        }

        $siswa->update($data);
        return redirect()->route('siswa.index')
            ->with(['status' => 'Data Siswa Berhasil Di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        File::delete('uploads/siswa/' . $siswa->foto);
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with(['status' => 'Data Siswa Berhasil Dihapus']);
    }

    public function nilai($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('tutor.siswa.nilai', [
            'siswa' => $siswa
        ]);
    }

    public function add_nilai(SiswaRequest $request)
    {

        $siswa = new Siswa();
        $data = $request->all();

        $siswa->update($data);

        return redirect()->route('siswa.index')
            ->with(['status' => 'Data Nilai Siswa Berhasil Ditambah']);
    }
}
