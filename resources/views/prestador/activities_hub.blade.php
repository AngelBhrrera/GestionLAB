@extends('layouts/prestador-layout')

@section('subhead')
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f0f0f0;
        }

        .containerH {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .gridH {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .boxH {
            width: calc(25% - 10px); 
            padding-top: calc(25% - 10px);
            position: relative;
            overflow: hidden; 
            border: 2px solid #333;
            cursor: pointer;
        }

        .boxH:hover {
            background-color: #ccc;
        }

        .boxH > div {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box-contentH {
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
<li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item active" aria-current="page">Actividades</li>
@endsection

@section('subcontent')
    <div class="containerH">
        <div class="gridH">
            <a href="{{ route('create_act') }}" class="boxH">
                <div class="box-contentH">Proponer Nueva Actividad</div>
            </a>
            <a href="{{ route('asign_act') }}" class="boxH">
                <div class="box-contentH">Ver Actividades Asignadas</div>
            </a>
            <a href="{{ route('misActividades') }}" class="boxH">
                <div class="box-contentH">Ver Todas Mis Actividades</div>
            </a>
            <a href="{{ route('actPull') }}" class="boxH">
                <div class="box-contentH">Pull de Actividades Abiertas</div>
            </a>
            <a href="{{ route('myProject') }}" class="boxH">
                <div class="box-contentH">Mi Proyecto</div>
            </a>
         </div>
    </div>
@endsection
