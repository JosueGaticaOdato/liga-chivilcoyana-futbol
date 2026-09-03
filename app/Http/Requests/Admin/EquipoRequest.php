<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EquipoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club_id' => ['required', 'exists:clubes,id'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'nombre' => ['nullable', 'string', 'max:100'],
            'activo' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'club_id.required' => 'Debes seleccionar un club.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
        ];
    }
}
