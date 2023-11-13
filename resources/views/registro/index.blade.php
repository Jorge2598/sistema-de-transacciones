@extends('adminlte::page')

@section('title', 'Registros')

@section('content_header')
    <h1>Historial de movimientos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="/tarjetas" class="btn btn-outline-info" >Regresar</a>

            <h2>Movimientos</h2>
            <table id="registros" class="table table-dark table-striped ">
                <thead>
                    <tr>
                        <th scope="col">Numero de tarjeta origen</th>
                        <th scope="col">Numero de tarjeta destino</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
        
                <tbody>
                            @foreach($registros as $registro)
                                <tr>
                                    <td>{{$registro->numeroOrigen}}</td>
                                    <td>{{$registro->numeroDestino}}</td>
                                    <td>$ {{number_format($registro->monto)}}</td>
                                    <td>{{$registro->created_at}}</td>           
                                </tr>
                            @endforeach
                </tbody>
            </table> 
        </div>
    </div> 
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css"/>
@stop

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script> 
    $(document).ready(function() {
    $('#registros').DataTable();
});
</script>
@stop




