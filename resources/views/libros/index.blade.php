<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Libros') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body bg-white">
                <table class="table table-hover mt-3">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Acciones</th>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Género</th>
                            <th scope="col">Año</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libros as $libro)       
                            <tr>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('libro.show', $libro->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-search"></i></a>
                                        <a href="{{ route('libro.edit', $libro->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                                        
                                        @role('admin')
                                            <a href="{{ route('libro.destroy', $libro->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                        @endrole
                                    </div>
                                </td>
                                <td>{{ $libro->titulo }}</td>
                                <td>{{ $libro->autor }}</td>
                                <td>{{ $cods_genero[trim($libro->genero)] ?? $libro->genero }}</td>
                                <td>{{ $libro->anho }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        {{ $libros->links() }}
                    </div>
                    <a class="btn btn-primary" href="{{ route('libro.create') }}">
                        <i class="bi bi-plus-circle"></i> Nuevo Libro
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!--

HAY QUE QUITAR ESTE COMENTARIO, LARAVEL NO LO IGNORA 

@extends('layout')
@section('title', 'Listado de libros')
@section('contenido')

<div class="container pt-4">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Autor</th>
                <th scope="col">Género</th>
                <th scope="col">Año</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libros as $libro)       
            


                <tr>
                    <th>
                        <a href="/libro/show/{{ $libro->id }}" class="btn btn-primary"><i class="bi bi-search"></i></a>
                        <a href="/libro/edit/{{ $libro->id }}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="/libro/destroy/{{ $libro->id }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>

                    </th>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->autor }}</td>
                    <td>{{ $cods_genero[trim($libro->genero)] ?? 'Error con la clave: ['.$libro->genero.']' }}</td>
                     //{{ $cods_genero[$libro->genero] }} 
                    <td>{{ $libro->anho }}</td>
                </tr>
            @endforeach

            {{ $libros->links() }}



        </tbody>
    </table>

    <a class="btn btn-primary" href="{{ route('libro.create') }}">Nuevo Libro</a>



</div>

@endsection

-->