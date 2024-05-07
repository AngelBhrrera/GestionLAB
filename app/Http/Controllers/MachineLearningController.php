<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use GuzzleHttp\Client;

class MachineLearningController extends Controller
{


    protected function exportarResultadosACSV($resultados)
    {
        $fileName = 'registro_acts.csv';

        $headers = [
            'id_actividad',
            'TEC',
            'nombre_categoria',
            'nombre_subcategoria',
            'id_prestador',
            'horario',
            'carrera',
            'experiencia',
            'experiencia_mensual',
            'experiencia_semanal',
            'periodo',
            'exp'
        ];

        $file = fopen($fileName, 'w');
        fputcsv($file, $headers);
        foreach ($resultados as $fila) {
            fputcsv($file, (array)$fila);
        }
        fclose($file);
        return $fileName;
    }

    protected function obtenerDatosDeSQL()
    {
        $query = <<<SQL
            SELECT
                ap.id_actividad,
                ap.exp,
                a.TEC,
                c.nombre AS nombre_categoria,
                COALESCE(sc.nombre, 'No Aplica') AS nombre_subcategoria,
                ap.id_prestador,
                u.horario,
                sp.semanas_actividad,
                u.carrera,
                u.experiencia,
                lb_m.total_exp AS experiencia_mensual,
                lb_w.total_exp AS experiencia_semanal,
                CASE
                    WHEN ch.horas_servicio < 160 THEN 1
                    WHEN ch.horas_servicio >= 160 AND ch.horas_servicio < 320 THEN 2
                    ELSE 3
                END AS periodo
            FROM
                actividades_prestadores ap
            JOIN
                actividades a ON ap.id_actividad = a.id
            JOIN
                categorias c ON a.id_categoria = c.id
            LEFT JOIN
                subcategorias sc ON a.id_subcategoria = sc.id
            LEFT JOIN
                users u ON ap.id_prestador = u.id
            JOIN
                solo_prestadores sp ON ap.id_prestador = sp.id
            LEFT JOIN
                lb_m ON u.id = lb_m.id_prestador
            LEFT JOIN
                lb_w ON u.id = lb_w.id_prestador
            LEFT JOIN
                cuenta_horas ch ON u.id = ch.id
            WHERE exp IS NOT null
        SQL;

        $resultados = DB::select($query);

        $fileName = $this->exportarResultadosACSV($resultados);

        return response()->json([            
            'archivo' => $fileName,
        ]);
    }

    protected function exportarPrestadoresACSV($resultados)
    {
        $fileName = 'users.csv';

        $headers = [
            'id_prestador',
            'horario',
            'semanas_actividad',
            'carrera',
            'experiencia',
            'experiencia_mensual',
            'experiencia_semanal',
            'periodo'
        ];

        $file = fopen($fileName, 'w');
        fputcsv($file, $headers);
        foreach ($resultados as $fila) {
            fputcsv($file, (array)$fila);
        }
        fclose($file);
        return $fileName;
    }

    public function obtenerPrestadores($t){
        $query = <<<SQL
            SELECT
                u.id,
                u.horario,
                sp.semanas_actividad,
                u.carrera,
                u.experiencia,
                lb_m.total_exp AS experiencia_mensual,
                lb_w.total_exp AS experiencia_semanal,
                CASE
                    WHEN ch.horas_servicio < 160 THEN 1
                    WHEN ch.horas_servicio >= 160 AND ch.horas_servicio < 320 THEN 2
                    ELSE 3
                END AS periodo
            FROM
                solo_prestadores AS sp
            LEFT JOIN
                users u ON u.id = sp.id
            LEFT JOIN
                lb_m ON u.id = lb_m.id_prestador
            LEFT JOIN
                lb_w ON u.id = lb_w.id_prestador
            LEFT JOIN
                cuenta_horas ch ON u.id = ch.id
            WHERE
                u.horario = '$t'
        SQL;

        $resultados = DB::select($query);

        $this->exportarPrestadoresACSV($resultados);

        return 0;
    }

    protected function exportarActividadACSV($resultados)
    {
        $fileName = 'act.csv';

        $headers = [
            'id_actividad',
            'exp_ref',
            'TEC',
            'nombre_categoria',
            'nombre_subcategoria',
        ];

        $file = fopen($fileName, 'w');
        fputcsv($file, $headers);
        foreach ($resultados as $fila) {
            fputcsv($file, (array)$fila);
        }
        fclose($file);
        return $fileName;
    }

    public function obtenerActividad($id){
        $query = <<<SQL
            SELECT
                a.id,
                a.exp_ref,
                a.TEC,
                c.nombre AS nombre_categoria,
                COALESCE(sc.nombre, 'No Aplica') AS nombre_subcategoria
            FROM
                actividades a
            JOIN
                categorias c ON a.id_categoria = c.id
            LEFT JOIN
                subcategorias sc ON a.id_subcategoria = sc.id
            WHERE a.id = $id
        SQL;

        $resultados = DB::select($query);

        $this->exportarActividadACSV($resultados);

        return 0;
    }

    public function obtenerRecomendaciones(Request $request)
    {
        $id = $request->input('id');
        $t = $request->input('otro_dato');
        $this->obtenerActividad($id);
        $this->obtenerPrestadores($t);
        
        $rutaPublic = public_path();
        // Agrega la ruta relativa al archivo deseado dentro de "public"
        $scriptPath  = $rutaPublic . '/decisionTreeModel.py';

        try {
          
            $command = 'python ' . $scriptPath;
            $output = shell_exec($command . ' 2>&1');
            // Decodificar la salida JSON del script Python
            $recomendaciones = json_decode($output, true);

            // Devolver las recomendaciones como respuesta
            return response()->json(['recomendaciones' => $recomendaciones]);
        } catch (Exception $e) {
            // Manejar el error: imprime el mensaje de error o haz lo que consideres adecuado
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function obtenerRecomendacionesDelta(Request $request)
    {
        $id = $request->input('id');
        $t = $request->input('otro_dato');
        $this->obtenerActividad($id);
        $this->obtenerPrestadores($t);

        try {
            // Hacer una petición POST al otro servicio
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'http://127.0.0.1:5000/predict');

            // Decodificar la respuesta JSON del otro servicio
            $recomendaciones = json_decode($response->getBody()->getContents(), true);

            // Devolver las recomendaciones como respuesta
            return response()->json(['recomendaciones' => $recomendaciones]);
        } catch (Exception $e) {
            // Manejar el error: imprime el mensaje de error o haz lo que consideres adecuado
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function obtenerRecomendacionesGamma(Request $request) //EL BUENO
    {
        echo "a";
        $id = $request->input('id');
        $t = $request->input('otro_dato');
        $this->obtenerActividad($id);
        $this->obtenerPrestadores($t);
    
        try {
            echo "b";
            // Crear un nuevo cliente Guzzle
            $client = new \GuzzleHttp\Client();
    
            // Hacer la solicitud GET
            $response = $client->request('POST', 'http://127.0.0.1:5000/predict');

            echo $response;
            echo $response->getBody();
    
            // Verificar que la respuesta HTTP es 200
            if ($response->getStatusCode() !== 200) {
                throw new Exception('La respuesta HTTP no fue 200');
            }
    
            // Obtener el cuerpo de la respuesta
            $body = $response->getBody()->getContents();
    
            // Verificar que el cuerpo de la respuesta no está vacío
            if (empty($body)) {
                throw new Exception('El cuerpo de la respuesta está vacío');
            }
    
            // Intentar decodificar la respuesta JSON
            $datos = json_decode($body, true);
    
            // Verificar si la decodificación fue exitosa
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Error al decodificar la respuesta JSON: ' . json_last_error_msg());
            }
    
            // Devolver los datos como respuesta
            return response()->json(['recomendaciones' => $datos]);
        } catch (Exception $e) {
            echo "c";
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
