<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:100'],
            'telefono' => ['required', 'string', 'max:20'],
            'empresa_id' => ['required', 'integer', 'exists:empresas,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo no tiene un formato válido.',
            'correo.max' => 'El correo no puede tener más de 100 caracteres.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',
            'empresa_id.required' => 'Debes seleccionar una empresa.',
            'empresa_id.integer' => 'Debes seleccionar una empresa.',
            'empresa_id.exists' => 'La empresa seleccionada no existe.',
        ];
    }
}
