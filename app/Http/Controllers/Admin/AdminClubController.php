<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ClubRequest;
use App\Models\Club;
use App\Models\Estadio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminClubController
{
    public function index(Request $request)
    {
        $query = Club::with('estadio')->withCount('equipos');

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('nombre_institucional', 'like', "%{$buscar}%")
                  ->orWhere('presidente', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('activo')) {
            $query->where('activo', $request->activo === '1');
        }

        $clubes = $query->orderBy('nombre')->paginate(12)->withQueryString();

        return view('admin.clubes.index', compact('clubes'));
    }

    public function create()
    {
        $estadios = Estadio::orderBy('nombre')->get();
        return view('admin.clubes.create', compact('estadios'));
    }

    public function store(ClubRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $baseSlug = Str::slug($data['nombre']);
            $slug = $baseSlug;
            $count = 1;
            while (Club::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;
        }

        $data['activo'] = $request->boolean('activo', true);

        if ($request->hasFile('escudo')) {
            $path = $request->file('escudo')->store('escudos', 'public');
            $data['escudo'] = $path;
        }

        $club = Club::create($data);

        return redirect()->route('admin.clubes.index')
            ->with('success', "Club '{$club->nombre}' creado con éxito.");
    }

    public function edit(Club $club)
    {
        $estadios = Estadio::orderBy('nombre')->get();
        return view('admin.clubes.edit', compact('club', 'estadios'));
    }

    public function update(ClubRequest $request, Club $club)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $baseSlug = Str::slug($data['nombre']);
            $slug = $baseSlug;
            $count = 1;
            while (Club::where('slug', $slug)->where('id', '!=', $club->id)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;
        }

        $data['activo'] = $request->boolean('activo', true);

        if ($request->hasFile('escudo')) {
            if ($club->escudo && Storage::disk('public')->exists($club->escudo)) {
                Storage::disk('public')->delete($club->escudo);
            }
            $path = $request->file('escudo')->store('escudos', 'public');
            $data['escudo'] = $path;
        }

        $club->update($data);

        return redirect()->route('admin.clubes.index')
            ->with('success', "Club '{$club->nombre}' actualizado con éxito.");
    }

    public function destroy(Club $club)
    {
        $nombre = $club->nombre;

        if ($club->escudo && Storage::disk('public')->exists($club->escudo)) {
            Storage::disk('public')->delete($club->escudo);
        }

        $club->delete();

        return redirect()->route('admin.clubes.index')
            ->with('success', "Club '{$nombre}' eliminado con éxito.");
    }
}
