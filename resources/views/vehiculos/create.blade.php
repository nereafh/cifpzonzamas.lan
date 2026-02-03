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

    <form action="/vehiculo/{{ $oper }}" method="POST">
        @csrf
        <input name="id_actual" type="hidden" value="{{ $vehiculo->id }}" />

        <div class="mb-3">
            <label class="form-label text-dark">Marca</label>
            <input {{ $disabled }} value="{{ old('marca', $vehiculo->marca) }}" type="text" name="marca" class="form-control @error('marca') is-invalid @enderror">
            @error('marca') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Modelo</label>
            <input {{ $disabled }} value="{{ old('modelo', $vehiculo->modelo) }}" type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror">
            @error('modelo') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Matricula</label>
            <input {{ $disabled }} value="{{ old('matricula', $vehiculo->matricula) }}" type="text" name="matricula" class="form-control @error('matricula') is-invalid @enderror">
            @error('matricula') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Combustible</label>
            <select {{ $disabled }} class="form-select @error('combustible') is-invalid @enderror" name="combustible">
                <option value=""></option>
                @foreach ($combustibles as $clave => $texto)    
                    <option value="{{ $clave }}" {{ old('combustible', $vehiculo->combustible) == $clave ? 'selected' : '' }}>{{ $texto }}</option>
                @endforeach
            </select>
            @error('combustible') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Estado</label>
            <select {{ $disabled }} class="form-select @error('estado') is-invalid @enderror" name="estado">
                <option value=""></option>
                @foreach ($estados as $clave => $texto)    
                    <option value="{{ $clave }}" {{ old('estado', $vehiculo->estado) == $clave ? 'selected' : '' }}>{{ $texto }}</option>
                @endforeach
            </select>
            @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-dark">Anho</label>
            <select {{ $disabled }} class="form-select @error('anho') is-invalid @enderror" name="anho">
                <option value=""></option>
                @foreach ($anhos as $clave => $texto)    
                    <option value="{{ $clave }}" {{ old('anho', $vehiculo->anho) == $clave ? 'selected' : '' }}>{{ $texto }}</option>
                @endforeach
            </select>
            @error('anho') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        @if (!$disabled)
            <button type="submit" class="btn btn-primary">Guardar</button>
        @endif

        @if ($oper == 'destroy' && $vehiculo->id)
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