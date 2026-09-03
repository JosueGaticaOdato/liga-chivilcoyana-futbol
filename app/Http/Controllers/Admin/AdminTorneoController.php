<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TorneoRequest;
use App\Models\Categoria;
use App\Models\Fase;
use App\Models\Temporada;
use App\Models\Torneo;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTorneoController
{
    public function index(Request $request)
    {
        $query = Torneo::with(['categoria', 'temporada'])
            ->withCount('partidos');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('temporada_id')) {
            $query->where('temporada_id', $request->temporada_id);
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $torneos = $query->orderByDesc('id')->paginate(10)->withQueryString();
        $temporadas = Temporada::orderByDesc('nombre')->get();
        $categorias = Categoria::orderBy('orden')->get();

        return view('admin.torneos.index', compact('torneos', 'temporadas', 'categorias'));
    }

    public function create()
    {
        $temporadas = Temporada::orderByDesc('nombre')->get();
        $categorias = Categoria::orderBy('orden')->get();

        return view('admin.torneos.create', compact('temporadas', 'categorias'));
    }

    public function store(TorneoRequest $request)
    {
        $data = $request->validated();

        $categoria = Categoria::find($data['categoria_id']);
        $temporada = Temporada::find($data['temporada_id']);

        if (empty($data['slug'])) {
            $baseSlug = Str::slug("{$categoria->nombre}-{$data['nombre']}-{$temporada->nombre}");
            $slug = $baseSlug;
            $count = 1;
            while (Torneo::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;
        }

        $tipoFase = $request->input('tipo_fase', 'round_robin');
        $nombreFase = $request->input('nombre_fase');

        if (empty($nombreFase)) {
            $nombreFase = match ($tipoFase) {
                'round_robin' => 'Todos contra todos',
                'eliminacion_simple' => 'Eliminación Directa',
                'eliminacion_ida_vuelta' => 'Play-offs (Ida y Vuelta)',
                default => 'Fase Inicial',
            };
        }

        $torneo = Torneo::create($data);

        // Crear la fase inicial con el tipo indicado por el usuario
        $fase = Fase::create([
            'torneo_id' => $torneo->id,
            'nombre' => $nombreFase,
            'orden' => 1,
            'tipo' => $tipoFase,
        ]);

        Zona::create([
            'fase_id' => $fase->id,
            'nombre' => 'General',
        ]);

        return redirect()->route('admin.torneos.index')
            ->with('success', "Torneo '{$torneo->nombre}' creado exitosamente con formato '{$nombreFase}'.");
    }

    public function edit(Torneo $torneo)
    {
        $temporadas = Temporada::orderByDesc('nombre')->get();
        $categorias = Categoria::orderBy('orden')->get();
        $primeraFase = $torneo->fases()->orderBy('orden')->first();

        return view('admin.torneos.edit', compact('torneo', 'temporadas', 'categorias', 'primeraFase'));
    }

    public function update(TorneoRequest $request, Torneo $torneo)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $categoria = Categoria::find($data['categoria_id']);
            $temporada = Temporada::find($data['temporada_id']);
            $baseSlug = Str::slug("{$categoria->nombre}-{$data['nombre']}-{$temporada->nombre}");
            $slug = $baseSlug;
            $count = 1;
            while (Torneo::where('slug', $slug)->where('id', '!=', $torneo->id)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;
        }

        $torneo->update($data);

        // Actualizar la fase inicial si se especificó un tipo
        if ($request->filled('tipo_fase')) {
            $primeraFase = $torneo->fases()->orderBy('orden')->first();
            if ($primeraFase) {
                $tipoFase = $request->input('tipo_fase');
                $nombreFase = $request->input('nombre_fase');
                if (empty($nombreFase)) {
                    $nombreFase = match ($tipoFase) {
                        'round_robin' => 'Todos contra todos',
                        'eliminacion_simple' => 'Eliminación Directa',
                        'eliminacion_ida_vuelta' => 'Play-offs (Ida y Vuelta)',
                        default => $primeraFase->nombre,
                    };
                }
                $primeraFase->update([
                    'tipo' => $tipoFase,
                    'nombre' => $nombreFase,
                ]);
            }
        }

        return redirect()->route('admin.torneos.index')
            ->with('success', "Torneo '{$torneo->nombre}' actualizado exitosamente.");
    }

    public function destroy(Torneo $torneo)
    {
        $nombre = $torneo->nombre;
        $torneo->delete();

        return redirect()->route('admin.torneos.index')
            ->with('success', "Torneo '{$nombre}' eliminado correctamente.");
    }
}
