<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tarjeta;
use App\Models\Registro;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarioAutenticado = Auth::user();
        $idUsuario = $usuarioAutenticado->id;
        $registros = Registro::where('idUsuario', $idUsuario)->get();
        return view('registro.index')->with('registros',$registros);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registro.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $usuarioAutenticado = Auth::user();
        $idUsuario = $usuarioAutenticado->id;
        $cuenta1 = $request->get('numero1');
        $cuenta2 = $request->get('numero2');
        $monto = $request->get('fondos');
        $modalidad = $request->input('opciones');
        $numeroCuentas = Tarjeta::where('idusuario', $idUsuario)->count();

        if($numeroCuentas == null){
            return back()->with(['error' => true, 'message' => 'no tienes tarjetas habilitadas para transacciones']);
        }else{
            if($cuenta1 == null){
                return back()->with(['error' => true, 'message' => 'por favor digita algun el numero de cuenta origen']);
            }else if($cuenta2 == null){
                return back()->with(['error' => true, 'message' => 'por favor digita algun el numero de cuenta destino']);
            }else{
                if($monto > 0){
                    if($cuenta1 == $cuenta2 ){
                        return back()->with(['error' => true, 'message' => 'No puedes transferir entre cuentas propias']);
            
                        }else if($modalidad == 1){
                            $tarjeta = Tarjeta::where('numero', $cuenta1)
                            ->where('idUsuario', $idUsuario)
                            ->first();
            
                            if($tarjeta){
                                $tarjeta2 = Tarjeta::where('numero', $cuenta2)
                                ->where('idUsuario', $idUsuario)
                                ->first();
                            
                                if($tarjeta2){
                                    return back()->with(['error' => true, 'message' => 'Estas pasando dinero a otra cuenta propia, dirigete a la opcion cuentas propias.']);
            
                                }else{
                                    $tarjeta2 = Tarjeta::where('numero', $cuenta2)->first();
                
                                    if($tarjeta2){
                                        $fondos1 = $tarjeta->fondos;
                
                                        if($fondos1 > 0){
                
                                            if($fondos1 > $monto){
                                                $montoAux = $fondos1 - $monto;
                                                $registro = new Registro();
                                                $registro->idUsuario = $idUsuario;
                                                $registro->numeroOrigen = $request->get('numero1');
                                                $registro->numeroDestino = $request->get('numero2');
                                                $registro->monto = $monto;
                                                $registro->save();
                                                Tarjeta::where('numero', $cuenta1)->update(['fondos' => $montoAux]);
                                                $fondos2 = $tarjeta2->fondos;
                                                $montoAux = $fondos2 + $monto;
                                                Tarjeta::where('numero', $cuenta2)->update(['fondos' => $montoAux]);
                                                return back()->with('success','success');
                                            }else{
                                                return back()->with(['error' => true, 'message' => 'transacción imposible, fondos insuficientes.']);
                                            }
            
                                        }else{
                                            return back()->with(['error' => true, 'message' => 'transaccion imposible, fondos de cuenta en 0.']);
                                        }
                                    }else{
                                        return back()->with(['error' => true, 'message' => 'la cuenta destino no existe.']);
                                    } 
                                }
                            }else{
                                return back()->with(['error' => true, 'message' => 'el numero de cuenta ingresado no existe.']);
                            }



                        }else{
                            if($numeroCuentas <= 1){
                                return back()->with(['error' => true, 'message' => 'transaccion imposible, solo cuentas con una cuenta propia']);
                            }else{
                                $tarjeta = Tarjeta::where('numero', $cuenta1)
                                ->where('idUsuario', $idUsuario)
                                ->first(); 
                    
                                }if($tarjeta){
                                    $tarjeta2 = Tarjeta::where('numero', $cuenta2)
                                    ->where('idUsuario', $idUsuario)
                                    ->first();
            
                                    if($tarjeta2){
                                        $fondos1 = $tarjeta->fondos;
            
                                        if($fondos1 > 0){
                                            if($fondos1 > $monto){
                                                $montoAux = $fondos1 - $monto;
                                                $registro = new Registro();
                                                $registro->idUsuario = $idUsuario;
                                                $registro->numeroOrigen = $request->get('numero1');
                                                $registro->numeroDestino = $request->get('numero2');
                                                $registro->monto = $monto;
                                                $registro->save();
                                                Tarjeta::where('numero', $cuenta1)->update(['fondos' => $montoAux]);
                                                $fondos2 = $tarjeta2->fondos;
                                                $montoAux = $fondos2 + $monto;
                                                Tarjeta::where('numero', $cuenta2)->update(['fondos' => $montoAux]);
                                                return back()->with('success','success');
                                            }else{
                                                return back()->with(['error' => true, 'message' => 'transaccion imposible, fondos insuficientes.']);
                                            }
                                    }else{
                                        return back()->with(['error' => true, 'message' => 'transaccion imposible, fondos de cuenta en 0.']);
                                    }           
                                }else{
                                    return back()->with(['error' => true, 'message' => 'estas pasando dinero a una cuenta de terceros, dirigete a la opcion cuentas de terceros.']);
                                }           
                            }else{
                                return back()->with(['error' => true, 'message' => 'el numero de cuenta ingresado no existe.']);
                            }
                        }
                        }else{
                            return back()->with(['error' => true, 'message' => 'Monto invalido, por favor ingrese un valor']);  
                        }
                    }  
                }
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
