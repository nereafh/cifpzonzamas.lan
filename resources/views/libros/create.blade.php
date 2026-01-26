<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>

    <div class="container pt-4">
        <ul>
        @foreach ($errors->all() as $error)
            <li  class="text-danger">{{ $error }}</li>
        @endforeach
        </ul>

        @if($datos['exito'])

           <p class="alert alert-success"> {{ $datos['exito'] }} </p>

        @endif


    
        <form action="/libro/{{ $oper }}" method="POST">

            @csrf

            <input name="id" type="hidden" value="{{ $libro->id }}" />
            <div class="mb-3">
                <label for="idtitulo" class="@error('titulo') text-danger @enderror form-label">Título</label>
                <input {{ $disabled }} value="{{ old('titulo',$libro->titulo) }}" type="text" name="titulo" class="@error('titulo') is-invalid @enderror form-control" id="idtitulo" aria-describedby="libroHelp">
                @error('titulo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div id="libroHelp" class="form-text">El título del libro.</div>
            </div>

            <div class="mb-3">
                <label for="idautor" class="@error('autor') text-danger @enderror form-label">Autor</label>
                <input {{ $disabled }}  value="{{ old('autor',$libro->autor) }}" type="text"  name="autor" class="@error('autor') is-invalid @enderror form-control" id="idautor" aria-describedby="autorHelp">
                @error('autor')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div id="autorHelp" class="form-text">El autor del libro.</div>
            </div>
            <div class="mb-3">

                <label for="idanho" class="@error('anho') text-danger @enderror form-label">Año publicación</label>
                <select  {{ $disabled }} class="@error('anho') is-invalid @enderror form-select" aria-label="2026" id="idanho" name="anho" aria-describedby="anhoHelp">
                    <option></option>
                    @php

                        $options = '';
                        for($anho= date('Y')-10; $anho <= date('Y'); $anho++)
                        {
                            $selected = $anho == $libro->anho ? 'selected' : '';

                            $options .= "<option value=\"{$anho}\" {$selected}>{$anho}</option>";
                        }

                            //$selected = $clave_genero == $libro->genero ? 'selected' : '';
                        echo $options;
                    @endphp

                   

                </select>
                @error('anho')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div id="anhoHelp" class="form-text">El año en que se publicó el libro.</div>
            </div>

            <div class="mb-3">

                <label for="idgenero" class="@error('genero') text-danger @enderror form-label">Género</label>
                <select  {{ $disabled }} class="@error('genero') is-invalid @enderror form-select" aria-label="Horror" id="idgenero" name="genero" aria-describedby="generoHelp">

                    @foreach ($cods_genero as $clave_genero => $texto_genero)    

                        @php

                            $selected = $clave_genero == $libro->genero ? 'selected' : '';

                        @endphp

                        <option value="{{ $clave_genero }}" {{ $selected }}>{{ $texto_genero }}</option>
                    @endforeach
                </select>
                @error('genero')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div id="generoHelp" class="form-text">El género literario.</div>
            </div>

            <div class="mb-3">
                <label for="iddescripcion" class="@error('descripcion') text-danger @enderror form-label">Descripción</label>
                <textarea  {{ $disabled }} class="@error('descripcion') is-invalid @enderror form-control" name="descripcion" id="iddescripcion" rows="3">{{ old('descripcion',$libro->descripcion) }}</textarea>
                @error('descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @if (!$disabled)
                <button type="submit" class="btn btn-primary">Submit</button>
            @endif
        </form>
        
        <a class="btn btn-info mt-3" href="{{ route('libro.index') }}">Volver</a>
    </div>
</body>
</html>