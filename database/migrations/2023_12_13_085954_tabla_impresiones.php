<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class tablaImpresiones extends Migration
{

    public function up()
    {
        DB::statement("
        CREATE VIEW ver_impresiones AS
        SELECT 
            i.nombre AS 'impresora', 
            s.id_Proyecto,
            COALESCE(p.titulo, 'Interno') AS 'proyecto', 
            s.id_Prestador,
            CONCAT(u.name, ' ', u.apellido) AS Prestador, 
            `fecha`,
            `nombre_modelo_stl`,
            `tiempo_impresion`,
            `color`,
            `piezas`, 
            s.estado,
            `peso`,
            `observaciones` 
        FROM seguimiento_impresiones s 
        INNER JOIN users u ON u.id = id_Prestador 
        INNER JOIN impresoras i ON i.id = id_Impresora 
        LEFT JOIN proyectos p ON p.id = id_Proyecto;
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //DB::statement("DROP VIEW ver_impresiones");
    }
}
