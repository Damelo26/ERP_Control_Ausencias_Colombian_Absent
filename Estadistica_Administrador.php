<?php
    require_once "Configuraciones/Funciones.php";
    $Total_Aprobados = mysqli_query($conexion,"SELECT * FROM ausencias WHERE cod_Estado = '1'");
    $Resultado_Aprobados = mysqli_num_rows($Total_Aprobados);
    $Total_Rechazados = mysqli_query($conexion,"SELECT * FROM ausencias WHERE cod_Estado = '2'");
    $Resultado_Rechazados = mysqli_num_rows($Total_Rechazados);
    $Total_Pendientes = mysqli_query($conexion,"SELECT * FROM ausencias WHERE cod_Estado = '3'");
    $Resultado_Pendientes = mysqli_num_rows($Total_Pendientes);
    $Total_Usuarios = mysqli_query($conexion,"SELECT * FROM usuario WHERE cod_usuario = '1'");
    $Resultado_Usuarios = mysqli_num_rows($Total_Usuarios);
    $annio = '2021';
    if(!empty($_POST)){
        if(empty($_POST['Fecha_Estadistico'])){
            $annio = '2021';
        }else{
            $annio = $_POST['Fecha_Estadistico'];
        }
    }
    $enero = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 1"));
    $chart_data= "{Mes: '".$annio."-01', Aprobados:'".$enero["Aprobados"]."', Rechazados:'".$enero["Rechazados"]."'}, ";
    $chart_data = substr($chart_data, 0);
    $febrero = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 2"));
    $chart_data= $chart_data."{Mes: '".$annio."-02', Aprobados:'".$febrero["Aprobados"]."', Rechazados:'".$febrero["Rechazados"]."'}, ";
    $marzo = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 3"));
    $chart_data= $chart_data."{Mes: '".$annio."-03', Aprobados:'".$marzo["Aprobados"]."', Rechazados:'".$marzo["Rechazados"]."'}, ";
    $abril = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 4"));
    $chart_data= $chart_data."{Mes: '".$annio."-04', Aprobados:'".$abril["Aprobados"]."', Rechazados:'".$abril["Rechazados"]."'}, ";
    $mayo = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 5"));
    $chart_data= $chart_data."{Mes: '".$annio."-05', Aprobados:'".$mayo["Aprobados"]."', Rechazados:'".$mayo["Rechazados"]."'}, ";
    $junio = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 6"));
    $chart_data= $chart_data."{Mes: '".$annio."-06', Aprobados:'".$junio["Aprobados"]."', Rechazados:'".$junio["Rechazados"]."'}, ";
    $julio = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 7"));
    $chart_data= $chart_data."{Mes: '".$annio."-07', Aprobados:'".$julio["Aprobados"]."', Rechazados:'".$julio["Rechazados"]."'}, ";
    $agosto = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 8"));
    $chart_data= $chart_data."{Mes: '".$annio."-08', Aprobados:'".$agosto["Aprobados"]."', Rechazados:'".$agosto["Rechazados"]."'}, ";
    $septiembre = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 9"));
    $chart_data= $chart_data."{Mes: '".$annio."-09', Aprobados:'".$septiembre["Aprobados"]."', Rechazados:'".$septiembre["Rechazados"]."'}, ";
    $octubre = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 10"));
    $chart_data= $chart_data."{Mes: '".$annio."-10', Aprobados:'".$octubre["Aprobados"]."', Rechazados:'".$octubre["Rechazados"]."'}, ";
    $noviembre = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 11"));
    $chart_data= $chart_data."{Mes: '".$annio."-11', Aprobados:'".$noviembre["Aprobados"]."', Rechazados:'".$noviembre["Rechazados"]."'}, ";
    $diciembre = mysqli_fetch_array(mysqli_query($conexion,"SELECT COUNT(IF(cod_Estado = 1, 1, null)) Aprobados, count(IF(cod_Estado = 2, 1, null)) Rechazados FROM ausencias WHERE YEAR(fecha) = '$annio' AND MONTH(fecha) = 12"));
    $chart_data= $chart_data."{Mes: '".$annio."-12', Aprobados:'".$diciembre["Aprobados"]."', Rechazados:'".$diciembre["Rechazados"]."'} ";
    $chart_data = substr($chart_data, 0);
    $QueryDonut = mysqli_query($conexion,"SELECT Es.nombre, COUNT(*) AS Total from ausencias au INNER JOIN tipo_estado Es ON au.cod_Estado = Es.cod_Estado WHERE YEAR(fecha) = '$annio'  GROUP BY Es.nombre ORDER by Total asc");
    $TotalDonut = mysqli_num_rows($QueryDonut);
    $DatosDonut = array();
    if($TotalDonut > 0){
        while($RowDonut = mysqli_fetch_array($QueryDonut)){
            $DatosDonut[] = array(
                'label' => $RowDonut["nombre"],
                'value' => $RowDonut["Total"]
            );
        }
    }else{
        $DatosDonut[] = array(
            'label' => "No hay datos",
            'value' => "0"
        );
    }
    $DatosDonut = json_encode($DatosDonut);
?>
<?php include_once 'Modulos/Templates/Header_Admin.php';  ?>
<div class="Contenido">
    <div class="Contenido_Cartas_Estadisticos">
        <div class="Carta_Estadisticos_Aprobados">
            <h5>Solicitudes aprobadas</h5>
            <p>
                <?php
                    echo $Resultado_Aprobados;
                ?>
            </p>
            <h7>Colombia absent</h7>
        </div>
        <div class="Carta_Estadisticos_Rechazados">
            <h5>Solicitudes rechazadas</h5>
            <p>
                <?php
                    echo $Resultado_Rechazados;
                ?>
            </p>
            <h7>Colombia absent</h7>
        </div>
        <div class="Carta_Estadisticos_Pendientes">
            <h5>Solicitudes pendientes</h5>
            <p>
                <?php
                    echo $Resultado_Pendientes;
                ?>
            </p>
            <h7>Colombia absent</h7>
        </div>
        <div class="Carta_Estadisticos_Usuarios">
            <h5>Usuarios registrados</h5>
            <p>
                <?php
                    echo $Resultado_Usuarios;
                ?>
            </p>
            <h7>Colombia absent</h7>
        </div>
    </div>
    <section class = "Fecha_Grafica_Estadistica">
        <div class="Fecha_Estadistico_Administrador">
            <form class="Formulario_Fecha_Estadistico" action="" method="post">
            <label for="Fecha_Estadistico"></label>
            <input type="text" name="Fecha_Estadistico" id="Fecha_Estadistico" placeholder="Digite la fecha">
            <button class="Btn_Fecha_Search" type="submit"><i class="fas fa-chart-line"></i> Buscar</button>
            </form>
        </div>
    </section>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <div class="row">
        <div class="Contenedor_Grafica">
            <h6>Total de solicitudes aprobadas y rechazadas en el año <?php echo $annio; ?></h6>
            <br /><br />
            <div id="chart"></div>
        </div>
        <div class="Contenedor_Grafica">
            <h6>Aprobados, rechazadas y pendientes del año <?php echo $annio; ?></h6>
            <br /><br />
            <div id="donut-example"></div>
        </div>
    </div>
</div>
<?php include_once 'Modulos/Templates/Footer_Admin.php';?>
<script>
   Morris.Line({
        element : 'chart',
        data:[<?php echo $chart_data; ?>],
        xkey:'Mes',
        ykeys:['Aprobados', 'Rechazados'],
        labels:['Aprobadas', 'Rechazadas'],
        xLabelAngle: 60,
        lineColors: ['#39FB71',' #ED5543'],
        resize: true
   });
   Morris.Donut({
  element: 'donut-example',
  data: <?php echo $DatosDonut; ?>,
  colors: ['rgb(57, 157, 251)','rgb(251, 91, 57)', 'rgb(74, 212, 92)'],
  resize: true
});
</script>