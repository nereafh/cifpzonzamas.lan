<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    //
    public function index()
    {
        $vehiculos = Vehiculo::paginate(10);
        return view('vehiculos.index', ['vehiculos' => $vehiculos, 'combustible' => Vehiculo::$combustibles, 'estado' => Vehiculo::$estados, 'anho' => Vehiculo::$anhos]);
    }

    public function create(Request $request) {
        $vehiculo = new Vehiculo();
        $datos = ['exito' => ''];
        $disabled = '';
        $combustibles = Vehiculo::$combustibles;
        $estados = Vehiculo::$estados;
        $anhos = Vehiculo::$anhos;
        $oper = 'create';
    
        if ($request->isMethod('post')) {
            try {
            $request->validate([
                'marca'    => ['required', 'string', 'min:3', 'regex:/^[A-Z]/'],
                'modelo'    => ['required', 'string', 'min:3', 'regex:/^[A-Z]/'],
                'matricula'       => 'required|unique:vehiculos,matricula', // En create no necesitas el chequeo de $oper
                'combustible' => 'required|in:DI,GA,EL',
                'estado' => 'required|in:DI,AL,TA',
                'anho' => 'required|in:2021,2022,2023',
            ],
            [
                'marca.regex' => 'La marca debe comenzar por una letra mayúscula.',
                'marca.required' => 'La marca es obligatoria.',
                'modelo.required'   => 'El modelo es obligatorio.',
                'matricula.required' => 'La matricula es obligatoria.',
                'matricula.unique' => 'Esta matricula ya existe.',
                'combustible.required' => 'El combustible es obligatorio.',
                'estado.required' => 'El estado es obligatorio.',
                'anho.required' => 'El año es obligatorio.'

            ]);
    
            $vehiculo->marca    = $request->input('marca');
            $vehiculo->modelo    = $request->input('modelo');
            $vehiculo->matricula       = $request->input('matricula');
            $vehiculo->combustible = $request->input('combustible');
            $vehiculo->estado = $request->input('estado');
            $vehiculo->anho = $request->input('anho');
            $vehiculo->save();
    
            $datos['exito'] = 'Vehiculo dado de alta!';
            $disabled = 'disabled';
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Si hay error de validación, volvemos a enviar la vista con los errores
            if ($request->input('modo') == 'ajax') {
                return view('vehiculos.create', [
                    'vehiculo' => $vehiculo,
                    'datos' => $datos,
                    'disabled' => $disabled,
                    'combustibles' => $combustibles,
                    'estados' => $estados,
                    'anhos' => $anhos,
                    'oper' => $oper
                ])->withErrors($e->validator)->render();
            }
        }
        }
    
        $combustibles = Vehiculo::$combustibles;
        $estados = Vehiculo::$estados;
        $anhos = Vehiculo::$anhos;
        if ($request->input('modo') == 'ajax') {
            return view('vehiculos.create', compact('vehiculo', 'datos', 'disabled', 'combustibles', 'estados', 'anhos'))->with('oper', 'create')->render();
        }
        return view('vehiculos.create', compact('vehiculo', 'datos', 'disabled', 'combustibles', 'estados', 'anhos'))->with('oper', 'create');
    }

    public function show(string $id, Request $request)
    {
        $vehiculo = Vehiculo::find($id);
        $combustibles = Vehiculo::$combustibles;
        $estados = Vehiculo::$estados;
        $anhos = Vehiculo::$anhos;
        $datos = ['exito' => ''];

        if ($request->input('modo') == 'ajax') {
            return view('vehiculos.create', ['vehiculo' => $vehiculo, 'datos' => $datos, 'combustibles' => $combustibles, 'estados' => $estados, 'anhos' => $anhos, 'disabled' => 'disabled', 'oper' => 'show'])->render();
        }
        return view('vehiculos.create', ['vehiculo' => $vehiculo, 'datos' => $datos, 'combustibles' => $combustibles, 'estados' => $estados, 'anhos' => $anhos, 'disabled' => 'disabled', 'oper' => 'show']);
    }

    public function edit(Request $request, string $id = '')
    {
        
        $id_Vehiculo = $id ?: $request->input('id_actual');
        $vehiculo = Vehiculo::find($id_Vehiculo );
        $combustibles = Vehiculo::$combustibles;
        $estados = Vehiculo::$estados;
        $anhos = Vehiculo::$anhos;
        $datos = ['exito' => ''];
        $disabled = '';
        $oper = 'edit';

        if ($request->isMethod('post')) {   
            try {
            $request->validate([
                // Añadimos la regex de la mayúscula que faltaba en el edit
                'marca'    => ['required', 'string', 'min:3', 'regex:/^[A-Z]/'],
                'modelo'    => ['required', 'string', 'min:3', 'regex:/^[A-Z]/'],
                'matricula'       => 'required|unique:vehiculos,matricula,' . $vehiculo->id,
                'combustible' => 'required|in:DI,GA,EL',
                'estado' => 'required|in:DI,AL,TA',
                'anho' => 'required|in:2021,2022,2023',
            ],
            [
                'marca.regex' => 'La marca debe comenzar por una letra mayúscula.',
                'marca.required' => 'La marca es obligatoria.',
                'modelo.required'   => 'El modelo es obligatorio.',
                'matricula.required' => 'La matricula es obligatoria.',
                'matricula.unique' => 'Esta matricula ya existe.',
                'combustible.required' => 'El combustible es obligatorio.',
                'estado.required' => 'El estado es obligatorio.',
                'anho.required' => 'El año es obligatorio.'
            ]);

            $vehiculo->marca    = $request->input('marca');
            $vehiculo->modelo    = $request->input('modelo');
            $vehiculo->matricula       = $request->input('matricula');
            $vehiculo->combustible = $request->input('combustible');
            $vehiculo->estado = $request->input('estado');
            $vehiculo->anho = $request->input('anho');
            $vehiculo->save();
            
            $datos['exito'] = 'Operación realizada correctamente';
            $disabled = 'disabled';
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si falla la validación en AJAX, devolvemos la vista con los errores
            if ($request->input('modo') == 'ajax') {
                return view('vehiculos.create', [
                    'vehiculo' => $vehiculo,
                    'datos' => $datos,
                    'disabled' => $disabled,
                    'combustibles' => $combustibles,
                    'estados' => $estados,
                    'anhos' => $anhos,
                    'oper' => $oper
                ])->withErrors($e->validator)->render();
            }
        }
    }

        if ($request->input('modo') == 'ajax') {
            return view('vehiculos.create', compact('vehiculo', 'datos', 'combustibles', 'estados', 'anhos', 'disabled'))->with('oper', 'edit')->render();
        }
        return view('vehiculos.create', compact('vehiculo', 'datos', 'combustibles', 'estados', 'anhos', 'disabled'))->with('oper', 'edit');
    
    }
    

    public function destroy(Request $request, string $id = '')
    {
        $id_Vehiculo = $id ?: $request->input('id_actual');
        $vehiculo = Vehiculo::find($id_Vehiculo);
        $combustibles = Vehiculo::$combustibles;
        $estados = Vehiculo::$estados;
        $anhos = Vehiculo::$anhos;

        if ($request->isMethod('post')) {
            if ($vehiculo) { $vehiculo->delete(); }
            $datos = ['exito' => 'Operación realizada con éxito'];
            return view('vehiculos.create', ['vehiculo' => new Vehiculo(), 'combustibles' => $combustibles, 'estados' => $estados, 'anhos' => $anhos, 'oper' => 'destroy', 'disabled' => 'disabled', 'datos' => $datos])->render();
        }

        return view('vehiculos.create', ['vehiculo' => $vehiculo, 'combustibles' => $combustibles, 'estados' => $estados, 'anhos' => $anhos, 'oper' => 'destroy', 'disabled' => 'disabled', 'datos' => ['exito' => '']]);
    }
}
