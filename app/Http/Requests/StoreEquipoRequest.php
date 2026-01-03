<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:100','unique:equipos,nombre'],
            'nombre_pila' => ['required','string','max:100','unique:equipos,nombre'],
            'fecha_creacion' => ['nullable','date'],
            'escudo' => ['nullable','image','mimes:png,jpg,jpeg,webp','max:2048'],
            'estadio' => ['nullable','string','max:100'],
            'descripcion' => ['nullable','string'],
            'activo' => ['nullable','boolean'],
        ];
    }
}
