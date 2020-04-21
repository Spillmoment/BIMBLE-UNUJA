<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorRequest extends FormRequest
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
            'nama_tutor' => 'required|min:3|max:100',
            'alamat'     => 'required|min:3|max:200',
            'email'      => 'required|email',
            'foto'       => 'required|image|mimes:jpg,jpeg,png,bmp',
            'username'   => 'required|min:3|max:100',
            'password'   => 'required',
            'konfirmasi_password'   => 'required|same:password',
            'keahlian'   => 'required',
        ];
    }
}
