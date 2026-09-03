<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClubRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $clubId = $this->route('clube') ? $this->route('clube')->id : ($this->route('club') ? $this->route('club')->id : null);

        return [
            'nombre' => ['required', 'string', 'max:100'],
            'nombre_institucional' => ['required', 'string', 'max:150'],
            'slug' => [
                'nullable',
                'string',
                'max:150',
                Rule::unique('clubes', 'slug')->ignore($clubId),
            ],
            'fecha_fundacion' => ['nullable', 'date'],
            'presidente' => ['nullable', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string'],
            'estadio_id' => ['nullable', 'exists:estadios,id'],
            'escudo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'activo' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre común del club es obligatorio.',
            'nombre_institucional.required' => 'El nombre institucional es obligatorio.',
            'escudo.image' => 'El archivo del escudo debe ser una imagen válida (PNG, JPG, SVG, WEBP).',
            'escudo.max' => 'La imagen no debe pesar más de 2MB.',
        ];
    }
}
