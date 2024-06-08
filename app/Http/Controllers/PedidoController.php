<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idUsuario' => 'required|integer|exists:users,id',
            'idCarrito' => 'required|integer|exists:carritos,id',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'codigoPostal' => 'required|string|max:20',
            'pais' => 'required|string|max:100',
        ]);

        $pedido = new Pedido([
            'idUsuario' => $request->idUsuario,
            'idCarrito' => $request->idCarrito,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'codigoPostal' => $request->codigoPostal,
            'pais' => $request->pais,
        ]);

        $pedido->save();

        return response()->json([
            'message' => 'Pedido creado exitosamente',
            'pedido' => $pedido
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($idUsuario)
    {
        $pedidos = Pedido::where('idUsuario', $idUsuario)->get();

        if ($pedidos->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron pedidos para este usuario'
            ], 404);
        }

        return response()->json($pedidos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required|string',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        $comentario = Comentarios::find($id);

        if (!$comentario) {
            return response()->json([
                'message' => 'Comentario no encontrado'
            ], 404);
        }

        // Actualizar el comentario
        $comentario->comentario = $request->comentario;
        $comentario->calificacion = $request->calificacion;
        $comentario->save();

        return response()->json([
            'message' => 'Comentario modificado exitosamente',
            'comentario' => $comentario
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
