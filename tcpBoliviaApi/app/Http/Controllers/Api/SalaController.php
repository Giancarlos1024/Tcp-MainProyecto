<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Muestra una lista de las salas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salas = Sala::all();
        return response()->json($salas);
    }

    /**
     * Almacena una nueva sala en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
        ]);

        $sala = Sala::create($request->all());

        return response()->json($sala, 201);
    }

    /**
     * Muestra una sala específica.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function show(Sala $sala)
    {
        return response()->json($sala);
    }

    /**
     * Actualiza una sala existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sala $sala)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
        ]);

        $sala->update($request->all());

        return response()->json($sala);
    }

    /**
     * Elimina una sala de la base de datos.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sala $sala)
    {
        $sala->delete();

        return response()->json(null, 204);
    }
}
