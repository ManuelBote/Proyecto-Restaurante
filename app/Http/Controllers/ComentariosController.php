<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Illuminate\Http\Request;

class ComentariosController extends Controller
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
            'idProducto' => 'required|integer|exists:productos,id',
            'comentario' => 'required|string',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        $comentario = new Comentarios   ([
            'idUsuario' => $request->idUsuario,
            'idProducto' => $request->idProducto,
            'comentario' => $request->comentario,
            'calificacion' => $request->calificacion,
        ]);

        $comentario->save();

        return response()->json([
            'message' => 'Comentario creado exitosamente',
            'comentario' => $comentario
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentarios $comentarios, $idProducto)
    {
        $comentarios = Comentarios::where('idProducto', $idProducto)->get();

        if ($comentarios->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron comentarios para este producto'
            ], 404);
        }

        return response()->json($comentarios);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentarios $comentarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentarios $comentarios)
    {
        //
    }
}
