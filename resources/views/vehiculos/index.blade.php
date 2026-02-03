{{-- Cargamos Bootstrap y los Iconos para que se vea igual que antes --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de vehiculos') }}
        </h2>
    </x-slot>

    <div class="container pt-4">
        @role('admin')
            {{-- TABLA ORIGINAL --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Matricula</th>
                        <th scope="col">Combustible</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Año</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)       
                        <tr>
                            <th>
                                <a onclick="cargarOperacion('{{ $vehiculo->id }}', 'show')" class="btn btn-primary"><i class="bi bi-search"></i></a>
                                <a onclick="cargarOperacion('{{ $vehiculo->id }}', 'edit')" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                <a onclick="cargarOperacion('{{ $vehiculo->id }}', 'destroy')" class="btn btn-danger"><i class="bi bi-trash"></i></a>                            </th>
                            <td>{{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->marca }}</td>
                            <td>{{ $vehiculo->matricula }}</td>
                            <td>{{ $combustible[trim($vehiculo->combustible)] ?? 'Error con la clave: ['.$vehiculo->combustible.']' }}</td>
                            <td>{{ $estado[trim($vehiculo->estado)] ?? 'Error con la clave: ['.$vehiculo->estado.']' }}</td>
                            <td>{{ $anho[trim($vehiculo->anho)] ?? 'Error con la clave: ['.$vehiculo->anho.']' }}</td>
                            </tr>
                    @endforeach
                    {{ $vehiculos->links() }}
                </tbody>
            </table>
        <button type="button" class="btn btn-primary mt-3" onclick="cargarOperacion('', 'create')">Nuevo Vehiculo</button>
        @else
            {{-- Mensaje para usuarios no admin (para que no vean la tabla vacía) --}}
            <div class="alert alert-info mt-4">
                No tienes permisos para gestionar vehiculos.
            </div>
        @endrole
    </div>
<div class="modal fade" id="ventanaModal" tabindex="-1" style="z-index: 9999;">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {{-- Aquí es donde metemos la clase modal-body y text-dark --}}
        <div id="contenidoModal" class="modal-body text-dark">
            </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Guardamos el token en una constante para no usar llaves de Blade dentro del fetch
const CSRF_TOKEN = '{{ csrf_token() }}';

function cargarOperacion(id, operacion) {
    let url = '';
    
    // Ajuste de URLs según TUS rutas en web.php
    switch(operacion) {
        case 'show':    
            url = `/vehiculo/show/${id}`; 
            break;
        case 'edit':    
            url = `/vehiculo/edit/${id}`; 
            break;
        case 'destroy': 
            url = `/vehiculo/destroy/${id}`; 
            break;
        case 'create':  
            url = `/vehiculo/create`; 
            break;
    }

    console.log("Intentando cargar:", url);

    fetch(url + '?modo=ajax')
        .then(response => {
            if (!response.ok) throw new Error('Error ' + response.status + ' en ruta: ' + url);
            return response.text();
        })
        .then(html => {
            document.getElementById('contenidoModal').innerHTML = html;
            
            // Abrimos el modal
            var elModal = document.getElementById('ventanaModal');
            var instancia = bootstrap.Modal.getOrCreateInstance(elModal);
            instancia.show();
        })
        .catch(error => {
            console.error("Error en el fetch:", error);
        });
}

document.addEventListener('submit', function(e) {
    if (e.target && e.target.closest('#contenidoModal')) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        formData.append('modo', 'ajax');

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            body: formData
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('contenidoModal').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>
</x-app-layout>

