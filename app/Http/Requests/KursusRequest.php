<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KursusRequest extends FormRequest
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
            'nama_kursus'   => 'required|min:3|max:100',
            'id_kategori'   => 'required',
            'id_tutor'      => 'required',
            'gambar_kursus' => 'required|nullable|image|mimes:jpeg,jpg,png,bmp',
            'biaya_kursus'  => 'required|digits_between:0,10',
            'diskon_kursus' => 'required|digits_between:0,10',
            'lama_kursus'   => 'required',
            'latitude'      => 'required|max:255',
            'longitude'     => 'required|max:255',
            'keterangan'    => 'required'
        ];
    }
}
