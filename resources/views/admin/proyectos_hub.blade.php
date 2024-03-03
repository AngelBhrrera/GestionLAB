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
<li class="breadcrumb-item active" aria-current="page">Proyectos</li>
@endsection

@section('subcontent')
    <div class="container">
        <div class="grid">
            <a href="{{ route('admin.create_proy') }}" class="box">
                <div class="box-content">Crear Proyecto</div>
            </a>
            <a href="{{ route('admin.view_proys') }}" class="box">
                <div class="box-content">Ver Proyectos</div>
            </a>
            <a href="{{ route('admin.proy_acts') }}" class="box">
                <div class="box-content">Asignar Actividades a Proyecto</div>
            </a>

         </div>
    </div>
@endsection
