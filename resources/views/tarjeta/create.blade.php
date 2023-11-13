@extends('adminlte::page')

@section('title', 'CRUD con Laravel 8')

@section('content_header')
    <h1>Listado de artículos</h1>
@stop

@section('content')
    <h2>Añadir tarjeta</h2>
    <form action="/tarjetas" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Numero de tarjeta</label>
            <input type="text" id="numero" name="numero" class="form-control" tabindex="2">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">fondos</label>
            <input type="integer" id="fondos" name="fondos" class="form-control" tabindex="2">
        </div>

        <a href="/tarjetas" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>

    </form>
@stop
