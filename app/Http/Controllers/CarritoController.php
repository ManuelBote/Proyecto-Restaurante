<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\DetalleCarrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carritos = Carrito::all();
        return response()->json($carritos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idUsuario' => 'required|integer|exists:users,id',
        ]);

        $carrito = new Carrito([
            'idUsuario' => $request->idUsuario,
            'total' => 0
        ]);

        $carrito->save();

        return response()->json([
            'message' => 'Carrito creado exitosamente',
            'carrito' => $carrito
        ], 201);
    }

    /** 
     * Display the specified resource.
     */
    public function show($id)
    {
        $carrito = Carrito::find($id);

        if (!$carrito) {
            return response()->json([
                'message' => 'Carrito no encontrado'
            ], 404);
        }

        return response()->json($carrito);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrito $carrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carrito = Carrito::find($id);

        if (!$carrito) {
            return response()->json([
                'message' => 'Carrito no encontrado'
            ], 404);
        }

        $carrito->delete();

        return response()->json([
            'message' => 'Carrito eliminado exitosamente'
        ], 200);
    }

    public function updateTotal($id)
    {
        $carrito = Carrito::find($id);

        if (!$carrito) {
            return response()->json([
                'message' => 'Carrito no encontrado'
            ], 404);
        }

        $detalles = DetalleCarrito::where('idCarrito', $id)->get();
        $nuevoTotal = 0;

        foreach ($detalles as $detalle) {
            $producto = Producto::find($detalle->idProducto);
            $nuevoTotal += $producto->precio * $detalle->cantidad;
        }

        $carrito->total = $nuevoTotal;
        $carrito->save();

        return response()->json([
            'message' => 'Total del carrito actualizado exitosamente',
            'carrito' => $carrito
        ], 200);
    }
}
