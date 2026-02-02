@if(request()->input('modo') != 'ajax')
    @extends('layout')
    @section('contenido')
@endif

<div class="container pt-4 text-dark">
    {{-- 
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </div>
    @endif
    --}}

    @if(isset($datos['exito']) && $datos['exito'])
        <p class="alert alert-success">{{ $datos['exito'] }}</p>
    @endif

    <form action="/socio/{{ $oper }}" method="POST">
        @csrf
        <input name="id_actual" type="hidden" value="{{ $socio->id }}" />

        <div class="mb-3">
            <label class="form-label text-dark">Nombre</label>
            <input {{ $disabled }} value="{{ old('nombre', $socio->nombre) }}" type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror">
            @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">DNI</label>
            <input {{ $disabled }} value="{{ old('dni', $socio->dni) }}" type="text" name="dni" class="form-control @error('dni') is-invalid @enderror">
            @error('dni') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Edad</label>
            <input {{ $disabled }} value="{{ old('edad', $socio->edad) }}" type="number" name="edad" class="form-control @error('edad') is-invalid @enderror">
            @error('edad') <div class="invalid-feedback">{{ $message }}</div> @enderror       
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Categoría</label>
            <select {{ $disabled }} class="form-select @error('categoria') is-invalid @enderror" name="categoria">
                <option value=""></option>
                @foreach ($categorias as $clave => $texto)    
                    <option value="{{ $clave }}" {{ old('categoria', $socio->categoria) == $clave ? 'selected' : '' }}>{{ $texto }}</option>
                @endforeach
            </select>
            @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">IBAN</label>
            <input {{ $disabled }} value="{{ old('iban', $socio->iban) }}" type="text" name="iban" class="form-control @error('iban') is-invalid @enderror">
            @error('iban') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        @if (!$disabled)
            <button type="submit" class="btn btn-primary">Guardar</button>
        @endif

        @if ($oper == 'destroy' && $socio->id)
            <button type="submit" class="btn btn-danger">Borrar</button>
        @endif

        @if(request()->input('modo') == 'ajax')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Volver
                </button>
        @endif
    </form>
</div>

@if(request()->input('modo') == 'ajax')
    @php die(); @endphp
@else
    @endsection
@endif