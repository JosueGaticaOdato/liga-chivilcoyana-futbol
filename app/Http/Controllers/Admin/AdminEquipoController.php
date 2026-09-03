<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EquipoRequest;
use App\Models\Categoria;
use App\Models\Club;
use App\Models\Equipo;
use Illuminate\Http\Request;

class AdminEquipoController
{
    public function index(Request $request)
    {
        $query = Equipo::with(['club', 'categoria']);

        if ($request->filled('club_id')) {
            $query->where('club_id', $request->club_id);
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('activo')) {
            $query->where('activo', $request->activo === '1');
        }

        $equipos = $query->orderBy('club_id')->paginate(15)->withQueryString();
        $clubes = Club::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('orden')->get();

        return view('admin.equipos.index', compact('equipos', 'clubes', 'categorias'));
    }

    public function create()
    {
        $clubes = Club::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('orden')->get();

        return view('admin.equipos.create', compact('clubes', 'categorias'));
    }

    public function store(EquipoRequest $request)
    {
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);

        // Si no tiene nombre especial (ej. "Colón B"), usar el nombre del club
        if (empty($data['nombre'])) {
            $club = Club::find($data['club_id']);
            $data['nombre'] = $club ? $club->nombre : 'Equipo';
        }

        $equipo = Equipo::create($data);

        return redirect()->route('admin.equipos.index')
            ->with('success', "Equipo '{$equipo->nombre}' registrado correctamente.");
    }

    public function edit(Equipo $equipo)
    {
        $clubes = Club::orderBy('nombre')->get();
        $categorias = Categoria::orderBy('orden')->get();

        return view('admin.equipos.edit', compact('equipo', 'clubes', 'categorias'));
    }

    public function update(EquipoRequest $request, Equipo $equipo)
    {
        $data = $request->validated();
        $data['activo'] = $request->boolean('activo', true);

        if (empty($data['nombre'])) {
            $club = Club::find($data['club_id']);
            $data['nombre'] = $club ? $club->nombre : 'Equipo';
        }

        $equipo->update($data);

        return redirect()->route('admin.equipos.index')
            ->with('success', "Equipo '{$equipo->nombre}' actualizado con éxito.");
    }

    public function destroy(Equipo $equipo)
    {
        $nombre = $equipo->nombre;
        $equipo->delete();

        return redirect()->route('admin.equipos.index')
            ->with('success', "Equipo '{$nombre}' eliminado con éxito.");
    }
}
