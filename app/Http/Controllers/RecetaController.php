<?php

namespace App\Http\Controllers;

use App\Models\ComentarioReceta;
use App\Models\Receta;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receta = Receta::with('alergenos')->get();
        return response()->json($receta);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombreReceta' => 'required|string|max:255',
            'ingredientes' => 'required|string',
            'instrucciones' => 'required|string',
            'imagen' => 'string|nullable',
        ]);

        $receta = new Receta([
            'nombreReceta' => $request->nombreReceta,
            'ingredientes' => $request->ingredientes,
            'instrucciones' => $request->instrucciones,
            'imagen' => $request->imagen,
            'calificacion' => 0,
        ]);

        $receta->save();

        if ($request->has('alergenos')) {
            $receta->alergenos()->attach($request->alergenos);
        }

        return response()->json([
            'message' => 'Receta creada exitosamente',
            'receta' => $receta
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $receta = Receta::with('alergenos', 'comentarios')->find($id);
        if (!$receta) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }
        return response()->json($receta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreReceta' => 'string|max:255',
            'ingredientes' => 'string',
            'instrucciones' => 'string',
            'imagen' => 'string|nullable',
        ]);

        $receta = Receta::find($id);
        if (!$receta) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }

        $receta->nombreReceta = $request->get('nombreReceta', $receta->nombreReceta);
        $receta->ingredientes = $request->get('ingredientes', $receta->ingredientes);
        $receta->instrucciones = $request->get('instrucciones', $receta->instrucciones);
        $receta->imagen = $request->get('imagen', $receta->imagen);

        $receta->save();

        if ($request->has('alergenos')) {
            $receta->alergenos()->sync($request->alergenos);
        }

        return response()->json([
            'message' => 'Receta actualizada exitosamente',
            'receta' => $receta
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $receta = Receta::find($id);
        if (!$receta) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }

        $receta->delete();

        return response()->json(['message' => 'Receta eliminada exitosamente']);
    }
    
}