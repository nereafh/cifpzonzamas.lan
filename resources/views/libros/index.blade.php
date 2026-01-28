{{-- Cargamos Bootstrap y los Iconos para que se vea igual que antes --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de libros') }}
        </h2>
    </x-slot>

    <div class="container pt-4">
        @role('admin')
            {{-- TABLA ORIGINAL CALCADA --}}
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
                            <td>{{ $libro->anho }}</td>
                        </tr>
                    @endforeach
                    {{ $libros->links() }}
                </tbody>
            </table>
            <a class="btn btn-primary mt-3" href="{{ route('libro.create') }}">Nuevo Libro</a>

        @else
            {{-- Mensaje para usuarios no admin (para que no vean la tabla vacía) --}}
            <div class="alert alert-info mt-4">
                No tienes permisos para gestionar libros.
            </div>
        @endrole
    </div>
</x-app-layout>

<!--

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
                    <td>{{ $cods_genero[$libro->genero] }}</td>
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