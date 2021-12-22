<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required', 'max:20',
            'surnames' => 'required', 'max:60',
            'dni' => 'required','unique:users', 'max:9',
            'password1' => 'required', 'max:30',
            'email' => 'required','unique:users', 'max:50',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre es demasiado largo',
            'surnames.required' => 'Los apellidos son requeridos',
            'surnames.max' => 'Los apellidos son demasiado largos',
            'dni.required' => 'El dni es requerido',
            'dni.unique:users' => 'El dni ya está registrado',
            'dni.max' => 'El dni es demasiado largo',
            'password1.required' => 'La contraseña es requerida',
            'password1.max '=>'La contraseña es demasiado larga',
            'email.required' => 'El email es requerido',
            'email.max '=>'El email es demasiado largo',
            'email.unique:users' => 'El email ya está registrado',
        ];
    }
}
