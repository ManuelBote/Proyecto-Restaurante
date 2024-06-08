<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('alergenos')->get();
        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombreProducto' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'idCategoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|string',
            
        ]);

        $producto = new Producto([
            'nombreProducto' => $request->nombreProducto,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'idCategoria' => $request->idCategoria,
            'stock' => TRUE,
            'imagen' => $request->imagen,
            'calificacion' => 0
        ]);

        $producto->save();

        if ($request->has('alergenos')) {
            $producto->alergenos()->attach($request->alergenos);
        }

        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreProducto' => 'sometimes|required|string|max:255',
            'precio' => 'sometimes|required|numeric',
            'descripcion' => 'nullable|string',
            'idCategoria' => 'sometimes|required|integer|exists:categorias,id',
            'imagen' => 'nullable|string|max:255',
        ]);

        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $producto->nombreProducto = $request->get('nombreProducto', $producto->nombreProducto);
        $producto->precio = $request->get('precio', $producto->precio);
        $producto->descripcion = $request->get('descripcion', $producto->descripcion);
        $producto->stock = $request->get('stock', $producto->stock);
        $producto->idCategoria = $request->get('idCategoria', $producto->idCategoria);
        $producto->imagen = $request->get('imagen', $producto->imagen);

        $producto->save();

        if ($request->has('alergenos')) {
            $producto->alergenos()->sync($request->alergenos);
        }

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'producto' => $producto
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $producto->delete();

        return response()->json([
            'message' => 'Producto eliminado exitosamente'
        ], 200);
    }

    /**
     * Método para actualizar la calificación de un producto
     */ 
    public function updateCalificacion($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        // Obtener todos los comentarios asociados al producto
        $comentarios = Comentarios::where('idProducto', $id)->get();

        if ($comentarios->isEmpty()) {
            return response()->json([
                'message' => 'No hay comentarios para este producto'
            ], 404);
        }

        // Calcular la media de las calificaciones
        $totalCalificacion = $comentarios->sum('calificacion');
        $cantidadComentarios = $comentarios->count();
        $mediaCalificacion = $totalCalificacion / $cantidadComentarios;

        // Actualizar la calificación del producto
        $producto->calificacion = $mediaCalificacion;
        $producto->save();

        return response()->json([
            'message' => 'Calificación del producto actualizada exitosamente',
            'producto' => $producto
        ], 200);
    }
}
