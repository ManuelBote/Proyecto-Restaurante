<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'idUsuario',
        'idCarrito',
        'direccion',
        'ciudad',
        'codigoPostal',
        'pais'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'idCarrito');
    }
}
