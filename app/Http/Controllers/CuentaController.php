<?php

namespace App\Http\Controllers;
use App\Models\Tarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarioAutenticado = Auth::user();
        $idUsuario = $usuarioAutenticado->id;
        $tarjetas = Tarjeta::where('idUsuario', $idUsuario)->get();
        $totalMontos = Tarjeta::where('idUsuario', $idUsuario)->sum('fondos');
        return view('cuenta.index')->with('tarjetas',$tarjetas)->with('totalMontos', $totalMontos);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
