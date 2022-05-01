<?php

namespace App\Http\Controllers;

use App\Models\antecedenteNoPato;
use App\Models\antecedentePato;
use App\Models\HistoriaClinica;
use App\Models\Paciente;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historias = HistoriaClinica::all();
        $pacientes = Paciente::all();

        return view('historias.index', compact('historias', 'pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all();
        return view('historias.create', compact('pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $antenp = new antecedenteNoPato();
        $antenp->inmunizacion = $request->inmunizacion;
        $antenp->alcohol = $request->alcohol;
        $antenp->tabaquismo = $request->tabaquismo;
        $antenp->padre = $request->padre;
        $antenp->enfermedad_padre = $request->enfermedad_padre;
        $antenp->madre = $request->madre;
        $antenp->enfermedad_madre = $request->enfermedad_madre;
        $antenp->cant_hermano = $request->cant_hermano;
        $antenp->cant_vivo = $request->cant_vivo;
        $antenp->enfermedad_h = $request->enfermedad_h;
        $antenp->save();

        $antep = new antecedentePato();
        
        $antep->cardiovas = $request->cardiovas;
        $antep->pulmonar = $request->pulmonar;
        $antep->digestivo = $request->digestivo;
        $antep->diabetes = $request->diabetes;
        $antep->renales = $request->renales;
        $antep->quirurgico = $request->quirurgico;
        $antep->alergico = $request->alergico;
        $antep->transfusion = $request->transfusion;
        $antep->medicamento = $request->medicamento;
        $antep->descripcion = $request->descripcionPato;
        $antep->save();

        $historia = new HistoriaClinica();
        $historia->descripcion = $request->descripcion;
        $historia->enfermedad_act = $request->enfermedad_act;
        $historia->diagnostico = $request->diagnostico;
        $historia->plan_terapeutico = $request->plan_terapeutico;
        $historia->id_paciente = $request->id_paciente;
        $historia->id_antep = $antep->id;
        $historia->id_antenp = $antenp->id;
        $historia->save();
    
        return redirect()->route('historias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historia = HistoriaClinica::find($id)->first();
        $antep = antecedentePato::where('id', $historia->id_antep)->first();
        $antenp = antecedenteNoPato::where('id', $historia->id_antenp)->first();
        $pacientes = Paciente::all();
        
        return view('historias.show', compact('historia','antep','antenp','pacientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $historia = HistoriaClinica::find($id)->first();
        $antep = antecedentePato::where('id', $historia->id_antep)->first();
        $antenp = antecedenteNoPato::where('id', $historia->id_antenp)->first();
        $pacientes = Paciente::all();
        
        return view('historias.edit', compact('historia','antep','antenp','pacientes'));
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
        $historia = HistoriaClinica::find($id)->first();

        $antenp = antecedenteNoPato::where('id', $historia->id_antenp)->first();
        $antenp->inmunizacion = $request->inmunizacion;
        $antenp->alcohol = $request->alcohol;
        $antenp->tabaquismo = $request->tabaquismo;
        $antenp->padre = $request->padre;
        $antenp->enfermedad_padre = $request->enfermedad_padre;
        $antenp->madre = $request->madre;
        $antenp->enfermedad_madre = $request->enfermedad_madre;
        $antenp->cant_hermano = $request->cant_hermano;
        $antenp->cant_vivo = $request->cant_vivo;
        $antenp->enfermedad_h = $request->enfermedad_h;
        $antenp->save();

        $antep = antecedentePato::where('id', $historia->id_antep)->first();
        $antep->cardiovas = $request->cardiovas;
        $antep->pulmonar = $request->pulmonar;
        $antep->digestivo = $request->digestivo;
        $antep->diabetes = $request->diabetes;
        $antep->renales = $request->renales;
        $antep->quirurgico = $request->quirurgico;
        $antep->alergico = $request->alergico;
        $antep->transfusion = $request->transfusion;
        $antep->medicamento = $request->medicamento;
        $antep->descripcion = $request->descripcionPato;
        $antep->save();

        $historia->descripcion = $request->descripcion;
        $historia->enfermedad_act = $request->enfermedad_act;
        $historia->diagnostico = $request->diagnostico;
        $historia->plan_terapeutico = $request->plan_terapeutico;
        $historia->id_paciente = $request->id_paciente;
        $historia->id_antep = $antep->id;
        $historia->id_antenp = $antenp->id;
        $historia->save();

        return redirect()->route('historias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $historia = HistoriaClinica::find($id);
        $antenp = antecedenteNoPato::where('id', $historia->id_antenp);
        $antep = antecedentePato::where('id', $historia->id_antep);
        $historia->delete();
        $antenp->delete();
        $antep->delete();

        return redirect()->route('historias.index');

    }
}
