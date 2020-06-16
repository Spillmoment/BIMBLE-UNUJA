<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_tutor' => 'required',
            'nama_siswa' => 'required',
            'alamat' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png,bmp',
            'username'   => 'required|min:3|max:100',
            'password'   => 'required|min:3',
            'konfirmasi_password'   => 'required|same:password',
            'keterangan' => 'required'
        ];
    }
}
