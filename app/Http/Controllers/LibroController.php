<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::paginate(10);
        return view('libros.index',['libros' => $libros,'cods_genero' => Libro::$cods_genero]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = ['exito' =>''];
        $disabled = ''; // Por defecto los campos están abiertos para escribir

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'titulo'      => 'required|string|max:255',
                'autor'       => 'required|string|max:255',
                'anho'        => 'required|integer',
                'genero'      => 'required|string|max:255',
                'descripcion' => 'required|string|max:1255',
            ]);

            $libro = new Libro();

            $libro->titulo      = $request->input('titulo');;
            $libro->autor       = $request->input('autor');;
            $libro->anho        = $request->input('anho');;
            $libro->genero      = $request->input('genero');;
            $libro->descripcion = $request->input('descripcion');
            $libro->save();   
            
            $data['exito'] = 'Operación realiza correctamente';
            $disabled = 'disabled'; // Bloqueamos tras éxito 

            // AJAX: Si estamos guardando desde el modal, devolvemos el formulario con el mensaje de éxito
            if ($request->input('modo') == 'ajax') {
                return view('libros.create', [
                    'datos' => $data, 
                    'libro' => $libro, 
                    'cods_genero' => Libro::$cods_genero, 
                    'disabled' => $disabled, 
                    'oper' => 'create'
                ])->render();
            }

        }

        $libro = new Libro();

        // AJAX: Para abrir el modal vacío la primera vez (cuando pulsas el botón "Nuevo Libro")
        if ($request->input('modo') == 'ajax') {
            return view('libros.create', [
                'datos' => $data, 
                'libro' => $libro, 
                'cods_genero' => Libro::$cods_genero, 
                'disabled' => $disabled, 
                'oper' => 'create'
            ])->render();
        }

        return view('libros.create',['datos' => $data,'libro' => $libro,'cods_genero' => Libro::$cods_genero, 'disabled' => '','oper' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request) //Añadir Request 
    {

        $datos = ['exito' => ''];
        $libro = Libro::find($id);

        // AJAX: Devolver solo formulario
        if ($request->input('modo') == 'ajax') {
            return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => 'disabled','oper' => 'show'])->render();
        }
        return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => 'disabled','oper' => 'show']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id='')
    {
        if ($request->isMethod('post')) {   

            $validated = $request->validate([
                'titulo'      => 'required|string|max:255',
                'autor'       => 'required|string|max:255',
                'anho'        => 'required|integer',
                'genero'      => 'required|string|max:255',
                'descripcion' => 'required|string|max:1255',
            ]);

            /*
            $datos_save = [];
            
            $datos_save['titulo']       = $request->input('titulo');;
            $datos_save['autor']        = $request->input('autor');;
            $datos_save['anho']         = $request->input('anho');;
            $datos_save['genero']       = $request->input('genero');;
            $datos_save['descripcion']  = $request->input('descripcion');


            Libro::where('id',$request->input('id'))->update($datos_save);

            */

            $libro = Libro::find($request->input('id'));

            
            $libro->titulo      = $request->input('titulo');;
            $libro->autor       = $request->input('autor');;
            $libro->anho        = $request->input('anho');;
            $libro->genero      = $request->input('genero');;
            $libro->descripcion = $request->input('descripcion');
            $libro->save();   
            
            $datos['exito'] = 'Operación realiza correctamente';
            $disabled = 'disabled';
            // AJAX: Devolver formulario con mensaje de éxito
            if ($request->input('modo') == 'ajax') {
                return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => $disabled,'oper' => 'edit'])->render();
            }
        }
        else
        {
            $datos = ['exito' => ''];
            $libro = Libro::find($id);
            $disabled = '';
        }
        // AJAX: Para la carga inicial del modal
        if ($request->input('modo') == 'ajax') {
            return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => $disabled,'oper' => 'edit'])->render();
        }
        return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => $disabled,'oper' => 'edit']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id = '')
    {
        // 1. Buscamos el ID (puede venir de la URL o del input 'id' del formulario)
        $id_Libro = $id ?: $request->input('id'); 
        $libro = Libro::find($id_Libro);
        
        $oper = 'destroy';
        $datos = ['exito' => ''];
        $disabled = 'disabled';
    
        if ($request->isMethod('post')) {
            if ($libro) { 
                $libro->delete(); 
            }
            $datos['exito'] = 'Libro eliminado correctamente';
            
            // Devolvemos un objeto vacío para que la vista no de error al buscar propiedades
            $libro = new Libro(); 
            
            if ($request->input('modo') == 'ajax') {
                return view('libros.create', [
                    'libro' => $libro, 
                    'cods_genero' => Libro::$cods_genero, 
                    'oper' => $oper, 
                    'disabled' => $disabled, 
                    'datos' => $datos
                ])->render();
            }
            return redirect()->route('libro.index');
        }
    
        // GET: Carga inicial del modal de confirmación
        if ($request->input('modo') == 'ajax') {
            return view('libros.create', [
                'libro' => $libro, 
                'cods_genero' => Libro::$cods_genero, 
                'oper' => $oper, 
                'disabled' => $disabled, 
                'datos' => $datos
            ])->render();
        }
    
        return view('libros.create', [
            'libro' => $libro, 
            'cods_genero' => Libro::$cods_genero, 
            'oper' => $oper, 
            'disabled' => $disabled, 
            'datos' => $datos
        ]);
    }

        
    }


    /*
    public function destroy(Request $request,string $id='')
    {
       if ($request->isMethod('post')) {   

            
            //$datos_save = [];
            
            //$datos_save['titulo']       = $request->input('titulo');;
            //$datos_save['autor']        = $request->input('autor');;
            //$datos_save['anho']         = $request->input('anho');;
            //$datos_save['genero']       = $request->input('genero');;
            //$datos_save['descripcion']  = $request->input('descripcion');


            //Libro::where('id',$request->input('id'))->update($datos_save);

            

            $libro = Libro::find($request->input('id'));

            
            $libro->delete();
            
            return redirect()->route('libro.index');
            
        }
        else
        {
            $datos = ['exito' => ''];
            $libro = Libro::find($id);
            $disabled = 'disabled';

            return view('libros.create',['libro' => $libro,'datos' => $datos,'cods_genero' => Libro::$cods_genero, 'disabled' => $disabled,'oper' => 'destroy']);
        }

        
    }

    */
