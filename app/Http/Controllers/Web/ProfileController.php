<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use App\Rules\UserOldPassword;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('web.web_profile');
    }

    public function kursus()
    {
        return view('web.web_profile');
    }

    public function pengaturan()
    {
        return view('web.web_profile');
    }

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'nama_pendaftar'        => 'required|min:3|max:100',
            'alamat'                => 'required|min:3|max:200',
            'email'                 => 'required|email|unique:pendaftar,email,' . $id,
            'foto'                  => 'sometimes|nullable|image|mimes:jpg,jpeg,png,bmp',
            'jenis_kelamin'         => 'required|in:L,P',
            'username'              => 'required|min:3|max:100|unique:pendaftar,username,' . $id,
        ]);

        $user = Pendaftar::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($request->file('foto')) {
                Storage::delete('public/uploads/pendaftar/profile/' . $user->foto);
                $file = $data['foto'];
                $file_name = 'pendaftar-' . $user->nama_pendaftar . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/uploads/pendaftar/profile', $file_name);
                $data['foto'] = $file_name;
            }
        }

        $user->update($data);
        return redirect()->back()->with(['success' => 'Data profil berhasil diupdate!']);
    }

    public function update_pengaturan(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', new UserOldPassword],
            'password' => ['required', 'min:3'],
            'konfirmasi_password' => ['same:password'],
        ]);

        $user = Pendaftar::findOrFail($id);
        $user->update(['password' => Hash::make($request->password)]);;
        return redirect()->back()->with(['success' => 'Password berhasil diupdate!']);
    }
}
