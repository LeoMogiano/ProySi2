@extends('adminlte::page')

@section('title', 'PROSALUD+')

@section('content_header')
    <h1>Registrar Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @error('name')
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Error!</strong> Este usuario ya está registrado.
                </div>
            @enderror
            <form action="{{ route('users.store') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Ingrese el Nombre de Usuario</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Ingrese el Correo Electronico</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="password">Ingrese la Contraseña</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="roles">Seleccione un rol</label>
                    <select name="roles" id="select-roles" class="form-control" onchange="habilitar()">
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>



                <br>

                <button class="btn btn-danger btn-sm" type="submit">Crear Usuario</button>
                <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">Volver</a>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', cargar, false);
        var rol = document.getElementById('select-roles');
        var empleados = document.getElementById('select-empleados');

        function habilitar() {
            if (rol.value > 0) {
                empleados.disabled = false
            } else {
                empleados.disabled = true
                empleados.value = 0
            }
        }

        function cargar() {
            if (rol.value > 0) {
                empleados.disabled = false
            } else {
                empleados.disabled = true
                empleados.value = 0
            }
        }
        /* function elegirE(){
            if(odontologos.value > 0){
                odontologos.disabled = false
            }
        } */
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
