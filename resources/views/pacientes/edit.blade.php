@extends('adminlte::page')

@section('title', 'Smartplusshouse')

@section('content_header')
    <h1>Editar datos de Paciente</h1>
@stop

@section('content')
    
    <form method="post" action="{{ route('pacientes.update', $paciente) }}">
        @csrf
        @method('PATCH')

                        <label for="ci">Ingresar Nombre</label>
                        <input type="text" name="ci" class="form-control"  value="{{$paciente->ci}}"  required>

                        <label for="nombre">Ingresar Nombre</label>
                        <input type="text" name="nombre" class="form-control"  value="{{$paciente->nombre}}"  required>

                        <label for="edad">Ingresar Edad</label>
                        <input type="number" name="edad" class="form-control"  value="{{$paciente->edad}}"  required>

                        <label for="sexo">Ingresar Genero</label>
                        <input type="text" name="sexo" class="form-control"  value="{{$paciente->sexo}}" required>

                        <label for="direccion">Ingresar Direccion</label>
                        <input type="text" name="direccion" class="form-control"  value="{{$paciente->direccion}}"  required>

                        <label for="telefono">Ingresar Telefono</label>
                        <input type="number" name="telefono" class="form-control"  value="{{$paciente->telefono}}"  required>
                    
                        <div class="form-group">
                            <label for="estado">Ingresar Estado</label>
                            <select name="estado"  class="focus border-primary  form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                            </select>
                        </div>

        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="{{ route('pacientes.index') }}">Volver</a>

    </form>
@stop