<?php

namespace App\Http\Controllers;

use App\Models\Socio;
use Illuminate\Http\Request;

class SocioController extends Controller
{
    public function index()
    {
        $socios = Socio::paginate(10);
        return view('socios.index', ['socios' => $socios, 'categoria' => Socio::$categorias]);
    }

    public function create(Request $request) {
        $socio = new Socio();
        $datos = ['exito' => ''];
        $disabled = '';
        $categorias = Socio::$categorias;
        $oper = 'create';
    
        if ($request->isMethod('post')) {
            try {
            $request->validate([
                'nombre'    => ['required', 'string', 'min:3', 'regex:/^[A-Z]/'],
                'dni'       => 'required|unique:socios,dni', // En create no necesitas el chequeo de $oper
                'categoria' => 'required|in:PL,OR,PR',
                'edad'      => 'required|numeric|min:18|max:120',
                'iban'      => ['required', 'regex:/^ES\d{22}$/'], // ES + exactamente 22 dígitos
            ],
            [
                'nombre.regex' => 'El nombre debe comenzar por una letra mayúscula.',
                'nombre.required' => 'El nombre es obligatorio.',
                'dni.required' => 'El DNI es obligatorio.',
                'dni.unique' => 'Este DNI ya existe.',
                'edad.required'   => 'La edad es obligatoria.',
                'edad.numeric'    => 'La edad debe ser un número.',
                'edad.min'        => 'El socio debe ser mayor de edad.',
                'categoria.required' => 'La categoría es obligatoria.',
                'iban.required' => 'El IBAN es obligatorio.',
                'iban.regex' => 'El IBAN debe ser ES + 22 dígitos.'

            ]);
    
            $socio->nombre    = $request->input('nombre');
            $socio->dni       = $request->input('dni');
            $socio->edad      = $request->input('edad');
            $socio->categoria = $request->input('categoria');
            $socio->iban      = $request->input('iban');
            $socio->save();
    
            $datos['exito'] = '¡Socio dado de alta!';
            $disabled = 'disabled';
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Si hay error de validación, volvemos a enviar la vista con los errores
            if ($request->input('modo') == 'ajax') {
                return view('socios.create', [
                    'socio' => $socio,
                    'datos' => $datos,
                    'disabled' => $disabled,
                    'categorias' => $categorias,
                    'oper' => $oper
                ])->withErrors($e->validator)->render();
            }
        }
        }
    
        $categorias = Socio::$categorias;
        if ($request->input('modo') == 'ajax') {
            return view('socios.create', compact('socio', 'datos', 'disabled', 'categorias'))->with('oper', 'create')->render();
        }
        return view('socios.create', compact('socio', 'datos', 'disabled', 'categorias'))->with('oper', 'create');
    }

    public function show(string $id, Request $request)
    {
        $socio = Socio::find($id);
        $categorias = Socio::$categorias;
        $datos = ['exito' => ''];

        if ($request->input('modo') == 'ajax') {
            return view('socios.create', ['socio' => $socio, 'datos' => $datos, 'categorias' => $categorias, 'disabled' => 'disabled', 'oper' => 'show'])->render();
        }
        return view('socios.create', ['socio' => $socio, 'datos' => $datos, 'categorias' => $categorias, 'disabled' => 'disabled', 'oper' => 'show']);
    }

    public function edit(Request $request, string $id = '')
    {
        
        $id_Socio = $id ?: $request->input('id_actual');
        $socio = Socio::find($id_Socio);
        $categorias = Socio::$categorias;
        $datos = ['exito' => ''];
        $disabled = '';
        $categorias = Socio::$categorias;
        $oper = 'edit';

        if ($request->isMethod('post')) {   
            try {
            $request->validate([
                // Añadimos la regex de la mayúscula que faltaba en el edit
                'nombre'    => ['required', 'string', 'min:3', 'regex:/^[A-Z]/'],
                'dni'       => 'required|unique:socios,dni,' . $socio->id,
                'categoria' => 'required|in:PL,OR,PR',
                'edad'      => 'required|numeric|min:18|max:120',
                'iban'      => ['required', 'regex:/^ES\d{22}$/'] // ES + exactamente 22 dígitos
            ],
            [
                'nombre.regex' => 'El nombre debe comenzar por una letra mayúscula.',
                'nombre.required' => 'El nombre es obligatorio.',
                'dni.required' => 'El DNI es obligatorio.',
                'dni.unique' => 'Este DNI ya existe.',
                'edad.required'   => 'La edad es obligatoria.',
                'edad.numeric'    => 'La edad debe ser un número.',
                'edad.min'        => 'El socio debe ser mayor de edad.',
                'categoria.required' => 'La categoría es obligatoria.',
                'iban.required' => 'El IBAN es obligatorio.',
                'iban.regex' => 'El IBAN debe ser ES + 22 dígitos.'
            ]);

            $socio->nombre    = $request->input('nombre');
            $socio->dni       = $request->input('dni');
            $socio->edad      = $request->input('edad');
            $socio->categoria = $request->input('categoria');
            $socio->iban      = $request->input('iban');
            $socio->save();   
            
            $datos['exito'] = 'Operación realizada correctamente';
            $disabled = 'disabled';
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si falla la validación en AJAX, devolvemos la vista con los errores
            if ($request->input('modo') == 'ajax') {
                return view('socios.create', [
                    'socio' => $socio,
                    'datos' => $datos,
                    'disabled' => $disabled,
                    'categorias' => $categorias,
                    'oper' => $oper
                ])->withErrors($e->validator)->render();
            }
        }
    }

        if ($request->input('modo') == 'ajax') {
            return view('socios.create', compact('socio', 'datos', 'categorias', 'disabled'))->with('oper', 'edit')->render();
        }
        return view('socios.create', compact('socio', 'datos', 'categorias', 'disabled'))->with('oper', 'edit');
    
    }
    

    public function destroy(Request $request, string $id = '')
    {
        $id_Socio = $id ?: $request->input('id_actual');
        $socio = Socio::find($id_Socio);
        $categorias = Socio::$categorias;

        if ($request->isMethod('post')) {
            if ($socio) { $socio->delete(); }
            $datos = ['exito' => 'Operación realizada con éxito'];
            return view('socios.create', ['socio' => new Socio(), 'categorias' => $categorias, 'oper' => 'destroy', 'disabled' => 'disabled', 'datos' => $datos])->render();
        }

        return view('socios.create', ['socio' => $socio, 'categorias' => $categorias, 'oper' => 'destroy', 'disabled' => 'disabled', 'datos' => ['exito' => '']]);
    }
}