<?php

namespace App\Http\Controllers;

use App\Models\DetalleCarrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleCarritoController extends Controller
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
            'idCarrito' => 'required|integer|exists:carritos,id',
            'idProducto' => 'required|integer|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Verificar si el producto existe y obtener su precio
        $producto = Producto::find($request->idProducto);

        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado'
            ], 404);
        }

        // Crear el detalle de carrito
        $detalleCarrito = new DetalleCarrito([
            'idCarrito' => $request->idCarrito,
            'idProducto' => $request->idProducto,
            'cantidad' => $request->cantidad,
        ]);

        $detalleCarrito->save();

        return response()->json([
            'message' => 'Detalle de carrito creado exitosamente',
            'detalleCarrito' => $detalleCarrito
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($idCarrito)
    {
        $detallesCarrito = DetalleCarrito::where('idCarrito', $idCarrito)->get();

        if ($detallesCarrito->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron detalles para el carrito especificado'
            ], 404);
        }

        return response()->json($detallesCarrito);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $detalleCarrito = DetalleCarrito::find($id);

        if (!$detalleCarrito) {
            return response()->json([
                'message' => 'Detalle de carrito no encontrado'
            ], 404);
        }

        // Actualizar el detalle de carrito
        $detalleCarrito->cantidad = $request->cantidad;
        $detalleCarrito->save();

        return response()->json([
            'message' => 'Detalle de carrito modificado exitosamente',
            'detalleCarrito' => $detalleCarrito
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detalleCarrito = DetalleCarrito::find($id);

        if (!$detalleCarrito) {
            return response()->json([
                'message' => 'Detalle de carrito no encontrado'
            ], 404);
        }

        $detalleCarrito->delete();

        return response()->json([
            'message' => 'Detalle de carrito eliminado exitosamente'
        ], 200);
    }
}
