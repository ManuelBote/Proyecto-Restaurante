<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    protected $table = 'recetas';

    protected $fillable = [
        'nombreReceta',
        'ingredientes',
        'instrucciones',
        'imagen'
    ];

    public function alergenos()
    {
        return $this->belongsToMany(Alergeno::class, 'alergeno_recetas', 'idReceta', 'idAlergeno');
    }

}
