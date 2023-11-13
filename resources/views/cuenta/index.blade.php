@extends('adminlte::page')

@section('title', 'Transacciones')

@section('content_header')
    
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h2>Cuentas</h2>
            </div>
            <table id="tarjetas" class="table table-dark  table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col">Numero de tarjeta</th>
                        <th scope="col">fondos</th>
                    </tr>
                </thead>

                <tbody>
                    @if(isset($tarjetas))
                        @foreach($tarjetas as $tarjeta)
                            <tr>
                                <td>{{$tarjeta->numero}}</td>
                                <td>$ {{number_format($tarjeta->fondos)}}</td>
                            </tr>
                        @endforeach
                    @else
                        <p>No hay tarjetas disponibles.</p>
                    @endif
                </tbody>   
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3>Fondos Totales</h3>
            <h4>$ {{ number_format($totalMontos)}}</h4>
        </div>
    </div>

@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css"/>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script> 
    $(document).ready(function() {
    $('#tarjetas').DataTable();
});
</script>

@stop
