<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tarjeta;
use Illuminate\Support\Facades\Auth;

class TarjetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarioAutenticado = Auth::user();
        $idUsuario = $usuarioAutenticado->id;
        $tarjetas = Tarjeta::where('idUsuario', $idUsuario)->get();
        return view('tarjeta.index')->with('tarjetas',$tarjetas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarjeta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuarioAutenticado = Auth::user();
        $idUsuario = $usuarioAutenticado->id;

        $tarjetas = new Tarjeta();
        $tarjetas->numero = $request->get('numero');
        $tarjetas->idUsuario = $idUsuario;
        $tarjetas->fondos = $request->get('fondos');
        $tarjetas->save();
        return redirect('/tarjetas');
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
