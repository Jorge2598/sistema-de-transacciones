@extends('adminlte::page')

@section('title', 'Transacciones')

@section('content_header')
    
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h1>Transacciones</h1>
            </div>
            <form id="transferir" action="/registros" method="post">
            @csrf
                <select name="opciones" id="opciones">
                    <option value="1">Cuenta de terceros</option>
                    <option value="2">Entre cuentas propias</option>
                </select>

                <div class="mb-3">
                    <label for="" class="form-label">Numero de cuenta origen</label>
                    <input type="text" id="numero" name="numero1" class="form-control" tabindex="2">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Numero de cuenta destino</label>
                    <input type="text" id="numero" name="numero2" class="form-control" tabindex="2" >
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Monto</label>
                    <input type="number" id="fondos" name="fondos" class="form-control" tabindex="2" pattern="[0-9]*" inputmode="numeric">
                </div>
                <button  type="submit" class="btn btn-outline-success" tabindex="4">Transferir</button>
            </form>
        </div>
    </div>

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
            <a href="registros" class="btn btn-outline-info">Movimientos</a>
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

<script>
   $('#transferir').on('submit', function(e){
        e.preventDefault();
        Swal.fire({
        title: "Estas seguro de efectuar la transaccion?",
        text: " ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText:"Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
            this.submit();
            } else {
                Swal.fire({
                position: "center",
                icon: "error",
                title: "Transaccion cancelada",
                showConfirmButton: false,
                timer: 1500
                });
            }
        });    
    })
</script>

@if(Session::has('success'))
    <script>
        Swal.fire({
        position: "center",
        icon: "success",
        title: "transaccion exitosa",
        showConfirmButton: false,
        timer: 1500
        });
    </script>
@endif
@if(Session::has('error'))
<script>
        Swal.fire({
        position: "center",
        icon: "error",
        title: "{{ session('message') }}",
        showConfirmButton: false,
        timer: 3500
        });
    </script>
@endif
@stop
