<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergeno extends Model
{
    use HasFactory;

    protected $table = 'alergenos';

    protected $fillable = [
        'nombreAlergeno'
    ];

    public function recetas()
    {
        return $this->belongsToMany(Receta::class, 'alergeno_recetas', 'idAlergeno', 'idReceta');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'alergeno_producto', 'idAlergeno', 'idProducto');
    }
}
