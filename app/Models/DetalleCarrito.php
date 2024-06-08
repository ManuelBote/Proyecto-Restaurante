<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    use HasFactory;

    protected $table = 'detalle_carritos';

    protected $fillable = [
        'idCarrito',
        'idProducto',
        'cantidad'
    ];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'idCarrito');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
}
