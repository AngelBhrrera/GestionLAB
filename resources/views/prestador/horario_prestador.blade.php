@extends('layouts/prestador-layout')

<?php

# definimos los valores iniciales para nuestro calendario
$month=date("n");
$year=date("Y");
$diaActual=date("j");

# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;

$diaSemana2=date("w");

# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
?>

@section('subhead')
<style>

#calendarB {
    font-family:Arial;
    font-size:12px;
}

#calendarB caption {
    text-align:left;
    padding:5px 10px;
    background-color:#003366;
    color:#fff;
    font-weight:bold;
}

#calendarB th {
    background-color:#006699;
    color:#fff;
    width:40px;
}

#calendarB td {
    text-align:right;
    padding:2px 5px;
    background-color:silver;
}

#calendarB .hoy {
    background-color:red;
}

#calendarB .assist {
    background-color:green;
}

#calendarB .service {
    background-color:blue;
}

</style>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Horario prestador</li>
        </ol>
    </nav>
@endsection


@section('subcontent')

    <div class="container">

        @if (isset(Auth::user()->horario))
            <h1 class="text-center">Horario: {{Auth::user()->horario}}</h1>
        @else
            <h1 class="text-center">No tienes horario asignado</h1>
        @endif      
    </div>

    <table id="calendarB">
	<caption><?php echo $meses[$month]." ".$year?></caption>

	<tr>

		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>

	</tr>

	<tr bgcolor="silver">

		<?php
		$future = false;
		$last_cell=$diaSemana+$ultimoDiaMes;
	

		// hacemos un bucle hasta 42, que es el máximo de valores que puede
		// haber... 6 columnas de 7 dias
		for($i=1;$i<=42;$i++){

			if($i==$diaSemana){
				$day=1;
				$diaSemanaF = $diaSemana-7;
			}

			if($i<$diaSemana || $i>=$last_cell){
				// celca vacia
				echo "<td>&nbsp;</td>";
			}else{

				if($day==$diaActual){
					$future = true;
					echo "<td class='hoy'>$day</td>";
				}else if ( $turn == "Sabatino"  && $diaSemanaF == 6 )
					if($future == false)
						echo"<td class='assist'>$day</td>";
					else 
						echo"<td class='service'>$day</td>";
				else if (($turn == "Matutino" || $turn == "Mediodia" || $turn == "Vespertino") && ($diaSemanaF == 1 || $diaSemanaF == 2 || $diaSemanaF == 3 || $diaSemanaF == 4 || $diaSemanaF == 5))
					if($future == false)
						echo"<td class='assist'>$day</td>";
					else  
						echo"<td class='service'>$day</td>";
				else
					echo "<td>$day</td>";

				$day++;
				$diaSemanaF++;
				if($diaSemanaF == 7){
					$diaSemanaF = 0;
				}
			}
			// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0){
				echo "</tr><tr>\n";
			}
		}
	?>

	</tr>

</table>


@endsection

