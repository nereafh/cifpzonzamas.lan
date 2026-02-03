<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\Datos;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LibroController;

use App\Http\Controllers\ProfileController; //para poder ver el perfil

use App\Http\Controllers\SocioController;

use App\Http\Controllers\VehiculoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/admin', function () {
return view('admin.dashboard');
})->middleware('auth');



Route::post('/procesar-datos', [Datos::class, 'procesar']);



Route::get('/procesar-datos', [Datos::class, 'procesar']);


Route::get('/usuario', [UsuarioController::class, 'index']);
//Route::get('/usuario/{id}', [UsuarioController::class, 'show'])->name('usuario.show');


Route::get('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');



// Solo usuarios logueados Y que sean 'admin' pueden entrar
Route::middleware(['auth'])->group(function () {
    
    Route::get('/libro', [LibroController::class, 'index'])->name('libro.index');
    Route::get('/libro/create', [LibroController::class, 'create'])->name('libro.create');
    Route::post('/libro/create', [LibroController::class, 'create']);
    Route::get('/libro/edit/{id}', [LibroController::class, 'edit'])->name('libro.edit');
    Route::post('/libro/edit', [LibroController::class, 'edit']);
    Route::get('/libro/show/{id}', [LibroController::class, 'show'])->name('libro.show');
    Route::get('/libro/destroy/{id}', [LibroController::class, 'destroy'])->name('libro.destroy');
    Route::post('/libro/destroy', [LibroController::class, 'destroy']);
    
});

// Solo usuarios logueados Y que sean 'admin' pueden entrar
Route::middleware(['auth'])->group(function () {
    Route::get('/socio', [SocioController::class, 'index'])->name('socio.index');
    Route::get('/socio/create', [SocioController::class, 'create'])->name('socio.create');
    Route::post('/socio/create', [SocioController::class, 'create']);
    Route::get('/socio/edit/{id}', [SocioController::class, 'edit'])->name('socio.edit');
    Route::post('/socio/edit', [SocioController::class, 'edit']);
    Route::get('/socio/show/{id}', [SocioController::class, 'show'])->name('socio.show');
    Route::get('/socio/destroy/{id}', [SocioController::class, 'destroy'])->name('socio.destroy');
    Route::post('/socio/destroy', [SocioController::class, 'destroy']);
});


// Solo usuarios logueados Y que sean 'admin' pueden entrar
Route::middleware(['auth'])->group(function () {
    Route::get('/vehiculo', [VehiculoController::class, 'index'])->name('vehiculo.index');
    Route::get('/vehiculo/create', [VehiculoController::class, 'create'])->name('vehiculo.create');
    Route::post('/vehiculo/create', [VehiculoController::class, 'create']);
    Route::get('/vehiculo/edit/{id}', [VehiculoController::class, 'edit'])->name('vehiculo.edit');
    Route::post('/vehiculo/edit', [VehiculoController::class, 'edit']);
    Route::get('/vehiculo/show/{id}', [VehiculoController::class, 'show'])->name('vehiculo.show');
    Route::get('/vehiculo/destroy/{id}', [VehiculoController::class, 'destroy'])->name('vehiculo.destroy');
    Route::post('/vehiculo/destroy', [VehiculoController::class, 'destroy']);
});

/*
// Solo usuarios logueados Y que sean 'admin' pueden entrar
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    Route::get('/libro', [LibroController::class, 'index'])->name('libro.index');
    Route::get('/libro/create', [LibroController::class, 'create'])->name('libro.create');
    Route::post('/libro/create', [LibroController::class, 'create']);
    Route::get('/libro/edit/{id}', [LibroController::class, 'edit'])->name('libro.edit');
    Route::post('/libro/edit', [LibroController::class, 'edit']);
    Route::get('/libro/show/{id}', [LibroController::class, 'show'])->name('libro.show');
    Route::get('/libro/destroy/{id}', [LibroController::class, 'destroy'])->name('libro.destroy');
    Route::post('/libro/destroy', [LibroController::class, 'destroy']);
    
});
*/

/*

Los roles se gestionan con middlewares aquí en las rutas
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Otras rutas protegidas para administradores
});

Esa sería un ruta protegida para administradores únicamente, un ejemplo.


Los permisos al contrario se gestionan en los controladores con:
$this->authorize('permission-name');
Ejemplo para el LibroController:
    public function create()
    {
        $this->authorize('create-libro');

        // Lógica para mostrar el formulario de creación de libro
    }

Y así en cada método que queramos proteger con permisos específicos.

También se pueden poner en las rutas con middlewares personalizados para permisos, pero es más común hacerlo en los controladores.
También se pueden poner en views con directivas blade @can y @cannot


*/