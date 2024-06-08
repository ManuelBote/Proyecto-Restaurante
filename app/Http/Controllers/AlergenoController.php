<?php

namespace App\Http\Controllers;

use App\Models\Alergeno;
use Illuminate\Http\Request;

class AlergenoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alergenos = Alergeno::all();
        return response()->json($alergenos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombreAlergeno' => 'required|string|unique:alergenos,nombreAlergeno|max:255',
        ]);

        $alergeno = new Alergeno([
            'nombreAlergeno' => $request->nombreAlergeno,
        ]);

        $alergeno->save();
        return response()->json([
            'message' => 'Alergeno creado exitosamente',
            'alergeno' => $alergeno
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alergeno $alergeno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $alergeno = Alergeno::findOrFail($id);

        $request->validate([
            'nombreAlergeno' => 'required|string|unique:alergenos,nombreAlergeno,' . $id . ',idAlergeno|max:255',
        ]);

        $alergeno->update([
            'nombreAlergeno' => $request->nombreAlergeno,
        ]);

        return response()->json([
            'message' => 'Alergeno actualizado exitosamente',
            'alergeno' => $alergeno
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alergeno = Alergeno::findOrFail($id);

        $alergeno->delete();

        return response()->json([
            'message' => 'Alergeno eliminado exitosamente'
        ]);
    }
}
