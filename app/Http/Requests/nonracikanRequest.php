<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class nonracikanRequest extends FormRequest
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
            'obat_id' => 'required',
            'resep_id' => 'required',
            'qty' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'obat_id.required' => 'kolom obat tidak boleh kosong !',
            'resep_id.required' => 'kolom signa tidak boleh kosong !',
            'qty.required' => 'kolom qty tidak boleh kosong !',
            'qty.numeric' => 'kolom qty harus berupa angka !',
        ];
    }
}
