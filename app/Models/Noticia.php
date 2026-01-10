<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Noticia extends Model
{
    protected $table = 'noticias';

    protected $fillable = [
        'titulo',
        'slug',
        'descripcion',
        'contenido',
        'imagen',
        'fecha_publicacion',
        'visitas',
        'autor',
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
    ];

    /**
     * Generar slug automáticamente si no viene seteado
     */
    protected static function booted()
    {
        static::creating(function ($noticia) {
            if (empty($noticia->slug)) {
                $noticia->slug = Str::slug($noticia->titulo);
            }
        });
    }
}
