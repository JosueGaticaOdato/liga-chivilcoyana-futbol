<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TorneoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $torneoId = $this->route('torneo') ? $this->route('torneo')->id : null;

        return [
            'nombre' => ['required', 'string', 'max:100'],
            'temporada_id' => ['required', 'exists:temporadas,id'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'slug' => [
                'nullable',
                'string',
                'max:150',
                Rule::unique('torneos', 'slug')->ignore($torneoId),
            ],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['required', 'in:planificado,en_curso,finalizado'],
            'tipo_fase' => ['nullable', 'in:round_robin,eliminacion_simple,eliminacion_ida_vuelta'],
            'nombre_fase' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del torneo es obligatorio.',
            'temporada_id.required' => 'Debes seleccionar una temporada.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'estado.required' => 'El estado es obligatorio.',
            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser posterior o igual a la de inicio.',
        ];
    }
}
