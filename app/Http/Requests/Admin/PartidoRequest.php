<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'torneo_id' => ['required', 'exists:torneos,id'],
            'fase_id' => ['required', 'exists:fases,id'],
            'zona_id' => ['required', 'exists:zonas,id'],
            'equipo_local_id' => ['required', 'exists:equipos,id', 'different:equipo_visitante_id'],
            'equipo_visitante_id' => ['required', 'exists:equipos,id'],
            'estadio_id' => ['nullable', 'exists:estadios,id'],
            'jornada' => ['nullable', 'integer', 'min:1'],
            'llave' => ['nullable', 'string', 'max:100'],
            'fecha_hora' => ['nullable', 'date'],
            'estado' => ['required', 'in:programado,en_vivo,finalizado,suspendido,postergado'],
            'goles_local' => ['nullable', 'integer', 'min:0'],
            'goles_visitante' => ['nullable', 'integer', 'min:0'],
            'goles_local_penales' => ['nullable', 'integer', 'min:0'],
            'goles_visitante_penales' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'torneo_id.required' => 'Debes seleccionar un torneo.',
            'fase_id.required' => 'Debes seleccionar una fase.',
            'zona_id.required' => 'Debes seleccionar una zona.',
            'equipo_local_id.required' => 'Debes seleccionar el equipo local.',
            'equipo_local_id.different' => 'El equipo local y el visitante no pueden ser el mismo.',
            'equipo_visitante_id.required' => 'Debes seleccionar el equipo visitante.',
            'estado.required' => 'El estado del partido es obligatorio.',
        ];
    }
}
