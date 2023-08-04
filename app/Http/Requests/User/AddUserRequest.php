<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "nama_user" => "required",
            "email" => "required",
            'username' => 'required',
            'no_hp' => 'required|numeric',
            'wa' => 'required|numeric',
            'pin' => 'required',
            'password' => 'required',
            'status' => 'required',
            'jabatan' => 'required',
            'gaji' => 'required|numeric',
            'join_date' => 'required'
        ];
    }
}
