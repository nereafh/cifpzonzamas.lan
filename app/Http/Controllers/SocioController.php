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
    
        if ($request->isMethod('post')) {
            $request->validate([
                'nombre'    => 'required|string|min:3',
                'dni'       => 'required|unique:socios,dni',
                'categoria' => 'required|in:PL,OR,PR',
                'iban'      => 'required'
            ]);
    
            $socio->nombre    = $request->input('nombre');
            $socio->dni       = $request->input('dni');
            $socio->edad      = $request->input('edad');
            $socio->categoria = $request->input('categoria');
            $socio->iban      = $request->input('iban');
            $socio->save();
    
            $datos['exito'] = '¡Socio dado de alta!';
            $disabled = 'disabled';
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

        if ($request->isMethod('post')) {   
            $request->validate([
                'nombre'    => 'required|string|min:3',
                'dni'       => 'required|unique:socios,dni,' . $socio->id,
                'categoria' => 'required|in:PL,OR,PR',
            ]);

            $socio->nombre    = $request->input('nombre');
            $socio->dni       = $request->input('dni');
            $socio->edad      = $request->input('edad');
            $socio->categoria = $request->input('categoria');
            $socio->iban      = $request->input('iban');
            $socio->save();   
            
            $datos['exito'] = 'Operación realizada correctamente';
            $disabled = 'disabled';
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