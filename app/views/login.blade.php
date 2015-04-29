@extends('index')
@section('login')


    <div class="panel panel-primary" id="panelEntrada">
        <div class="panel-heading">
            <h3 class="panel-title">Proporcione sus datos</h3>
        </div>
        <div class="panel-body" >
            <select>
                <option value="1">Alumno</option>
                <option value="2">Maestro</option>
                <option value="3">Administrativo</option>
                <option value="4">Asesor Externo</option>
            </select><br/>
            <input type="text" id="txtUsuario" class="form-control" placeholder="Usuario" autofocus>
            <input type="password" id="txtClave" class="form-control" placeholder="Contraseña">
            <button id="btnEntrar" class="btn btn-success btn-lg btn-block">
                Entrar
                <span class="glyphicon glyphicon-log-out"></span>
            </button>

        </div>
    </div>

 @stop