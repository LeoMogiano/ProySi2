<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\medico;
use App\Models\User;
use Illuminate\Http\Request;

class medicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $medicos = medico::all();
       $esps = Especialidad::all();
       return view('medicos.index',compact('medicos','esps'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion para que sea requerido
        $request->validate([
            'nombre' => 'required',
            'edad' => 'required',
            'sexo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'estado' => 'required'

        ]);
        //crea el medico atributo por atributo
        $medico=new medico();
        $medico->nombre=$request->input('nombre');
        $medico->edad=$request->input('edad');
        $medico->sexo=$request->input('sexo');
        $medico->direccion=$request->input('direccion');
        $medico->telefono=$request->input('telefono');
        $medico->estado=$request->input('estado');
        $medico->save();

        $user = new User();
        $user->name = $medico->nombre;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->cod_p = $medico->id;
        $user->assignRole('Medico');
        $user->save();

        $esp = new Especialidad();
        $esp->descripcion = $request->input('descripcion');
        $esp->id_medico = $medico->id;
        $esp->save();
        
        return redirect()->route('medicos.index', compact('medico','esp'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medico=medico::findOrFail($id);
        return view('medicos.edit',compact('medico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $medico=medico::findOrFail($id);
        $medico->nombre=$request->input('nombre');
        $medico->edad=$request->input('edad');
        $medico->sexo=$request->input('sexo');
        $medico->direccion=$request->input('direccion');
        $medico->telefono=$request->input('telefono');
        $medico->estado=$request->input('estado');
        $medico->save();

        return redirect()->route('medicos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $medico= medico::findOrFail($id);

        $esp=Especialidad::where('id_medico',$medico->id);
        $esp->delete();

        $medico->delete();

        $user = User::where('cod_p', $medico->id);
        $user->delete();

        return redirect()->route('medicos.index');


    }

    public function especialidad($id)
    {
        $medico= medico::findOrFail($id);
        return view('medicos.especialidad',compact('medico'));
    }

    public function esp_store(Request $request)
    {
       $esp = new Especialidad();
       $esp->descripcion = $request->input('descripcion');
       $esp->id_medico = $request->input('id_medico');
       $esp->save();

       return redirect()->route('medicos.index');
        
    }
}
