<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; 
    
    protected $fillable = [
        'nombreProducto',
        'precio',
        'descripcion',
        'stock',
        'idCategoria',
        'imagen',
        'calificacion'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class, 'idProducto');
    }

    public function alergenos()
    {
        return $this->belongsToMany(Alergeno::class, 'alergeno_productos', 'idProducto', 'idAlergeno');
    }
}
