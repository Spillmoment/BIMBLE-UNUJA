<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tutor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('tutor.dashboard.index');
    }

    public function profile()
    {
        $user =  Tutor::where('id', Auth::id())->get();
        return view('tutor.pengaturan.index', [
            'tutor' => $user
        ]);
    }

    public function update_profile(Request $request, $id)
    {
        $user = Tutor::findOrFail($id);
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

        $data = $request->all();

        if ($request->input('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }

        if ($request->hasFile('foto')) {
            if ($request->file('foto')) {
                if ($user->foto && file_exists(storage_path('app/public/' . $user->foto))) {
                    Storage::delete('public/' . $user->foto);
                    $file = $request->file('foto')->store('tutor', 'public');
                    $data['foto'] = $file;
                }
            }
        }

        $user->update($data);
        return redirect()->back()->with([
            'status' => 'Data Berhasil Disimpan'
        ]);
    }
}
