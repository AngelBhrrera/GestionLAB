@extends('layouts/admin-layout')

@section('subhead')
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .box {
            width: calc(25% - 10px); /* Ancho del 25% del contenedor con espacio entre los cuadrados */
            padding-top: calc(25% - 10px); /* Altura del 25% del contenedor con espacio entre los cuadrados */
            position: relative;
            overflow: hidden; /* Ocultar el contenido desbordado */
            border: 2px solid #333;
            cursor: pointer;
        }

        .box:hover {
            background-color: #ccc;
        }

        .box > div {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box-content {
            font-size: 24px;
        }

        @media (max-width: 600px) {
            .grid {
                flex-direction: column;
            }
            .box {
                width: calc(50% - 10px);
                padding-top: calc(50% - 10px);
            }
        }
    </style>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item active" aria-current="page">Gestion</li>
@endsection

@section('subcontent')
    <div class="container">
        <div class="grid">
            <a href="{{ route('admin.registro') }}" class="box">
                <div class="box-content">Registrar Usuario</div>
            </a>
            <a href="{{ route('admin.general') }}" class="box">
                <div class="box-content">Ver Todos los Usuarios</div>
            </a>
            <a href="{{ route('admin.administradores') }}" class="box">
                <div class="box-content">Ver Todos los Administradores</div>
            </a>
            <a href="{{ route('admin.premios') }}" class="box">
                <div class="box-content">Registrar Premios</div>
            </a>
            <a href="{{ route('admin.gestor_premios') }}" class="box">
                <div class="box-content">Ver Premios Otorgados</div>
            </a>
            <a href="{{ route('admin.categorias') }}" class="box">
                <div class="box-content">Registrar Categorias / Subcategorias</div>
            </a>
            <a href="{{ route('admin.diasfestivos') }}" class="box">
                <div class="box-content">Registrar Dia Festivo / Vacaciones</div>
            </a>
            <a href="{{ route('admin.diasfestivos') }}" class="box">
                <div class="box-content">Registrar Dia No Laboral</div>
            </a>

         </div>
    </div>
@endsection
