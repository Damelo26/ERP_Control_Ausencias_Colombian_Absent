<?php
include "Configuraciones/Funciones.php";
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';
if ($accion == 'aprobar') {
    $cod_historial_ausencias = $_GET['id'];
    $SentenciaSQL = mysqli_query($conexion, "UPDATE ausencias au SET au.cod_Estado = '1' WHERE au.cod_ausencias = '$cod_historial_ausencias'");
    echo $SentenciaSQL;
} else if ($accion == 'rechazar') {
    $cod_historial_ausencias = $_GET['id'];
    $SentenciaSQL = mysqli_query($conexion, "UPDATE ausencias au SET au.cod_Estado = '2' WHERE au.cod_ausencias = '$cod_historial_ausencias'");
    echo $SentenciaSQL;
} else {
    $Busqueda_Tabla_Historial_Ausencias = mysqli_query($conexion, "SELECT H_A.cod_historial_ausencias as Codigo, U.cedula, U.primer_nombre, U.segundo_nombre, U.primer_apellido, U.segundo_apellido, U.imagen, au.fecha,  au.fecha_final, au.dias_ausentes, au.cod_ausencias, Tipo_au.nombre_tipo_ausencias as tipo, Es.nombre as Estado from historial_ausencias H_A INNER JOIN usuario U ON H_A.cedula = U.cedula INNER JOIN ausencias au ON H_A.cod_ausencias = au.cod_ausencias INNER JOIN tipo_ausencias Tipo_au ON au.cod_tipo_ausencias = Tipo_au.cod_tipo_ausencias INNER JOIN tipo_estado Es ON Es.cod_Estado = au.cod_Estado WHERE au.cod_Estado = 3");
    $busqueda = mysqli_query($conexion, "SELECT * FROM historial_ausencias");
    $eventos = array();
    $Resultado_Tabla = mysqli_num_rows($Busqueda_Tabla_Historial_Ausencias);
    if ($Resultado_Tabla > 0) {
        while ($datos = mysqli_fetch_array($Busqueda_Tabla_Historial_Ausencias)) {
            // $fecha_actual = date("d-m-Y");
            //  //sumo 1 día
            // echo date("d-m-Y",strtotime($fecha_actual."+ 1 days")); 
            // //resto 1 día
            // echo date("d-m-Y",strtotime($fecha_actual."- 1 days"));
            $fecha = date_create($datos['fecha_final']);
            date_add($fecha, date_interval_create_from_date_string("1 day"));
            $fecha_final = date_format($fecha,"Y-m-d");
            $title = 'Solicitud '.$datos['tipo'];
            $evento = array(
                'title' => $title,
                'cod_ausencias' => $datos['cod_ausencias'],
                'codigo' => $datos['Codigo'],
                'cedula' =>  $datos['cedula'],
                'primer_nombre' => $datos['primer_nombre'],
                'segundo_nombre' => $datos['segundo_nombre'],
                'primer_apellido' => $datos['primer_apellido'],
                'segundo_apellido' => $datos['segundo_apellido'],
                'imagen' => $datos['imagen'],
                'tipo' => $datos['tipo'],
                'estado' => $datos['Estado'],
                'start' => $datos['fecha'],
                'end' => $fecha_final,
                'fecha_inicial' => $datos['fecha'],
                'fecha_final' => $datos['fecha_final'],
                'dias' => $datos['dias_ausentes'],
            );
            array_push($eventos, $evento);
        }
    }
    $json_string = json_encode($eventos);
    echo json_encode($eventos);
}
