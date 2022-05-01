<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\medico;
use App\Models\Paciente;
use Illuminate\Http\Request;

class citaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = medico::all();
        $pacientes = Paciente::all();
        $citas = Cita::all();

        return view('citas.index', compact('medicos', 'pacientes', 'citas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicos = medico::all();
        $pacientes = Paciente::all();

        return view('citas.create', compact('medicos', 'pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cita = new Cita();
        $cita->fecha = $request->input('fecha');
        $cita->hora = $request->input('hora');
        $cita->descripcion = $request->input('descripcion');
        $cita->id_medico = $request->input('id_medico');
        $cita->id_paciente = $request->input('id_paciente');
        $cita->save();
        return redirect()->route('citas.index');
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
        $cita = Cita::where('id',$id)->first();
        //$medico = medico::where('id', $cita->id_medico);
        //$paciente = Paciente::where('id', $cita->id_paciente);
        $medicos = medico::all();
        $pacientes = Paciente::all();
        return view('citas.edit', compact('medicos', 'pacientes', 'cita'));
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
        $cita = Cita::where('id',$id)->first();
        $cita->fecha = $request->input('fecha');
        $cita->hora = $request->input('hora');
        $cita->descripcion = $request->input('descripcion');
        $cita->id_medico = $request->input('id_medico');
        $cita->id_paciente = $request->input('id_paciente');
        $cita->save();

        return redirect()->route('citas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::where('id',$id)->first();
        $cita->delete();

        return redirect()->route('citas.index');
    }
}
