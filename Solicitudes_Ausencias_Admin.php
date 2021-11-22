<?php include_once 'Modulos/Templates/Header_Admin.php';
include "Configuraciones/Funciones.php"; ?>


<script src="js/main.js"></script>
<script src="js/main.min.js"></script>
<link rel="stylesheet" type="text/css" href="CSS/main.css">
<link rel="stylesheet" type="text/css" href="CSS/main.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/es.js"></script>





<script>
    function myFunction() {
        var y = document.getElementById("idCalendar");
        var x = document.getElementById("Contenedor_Administrar_Historial");
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
        } else {
            x.style.display = "none";
            y.style.display = "block";
        }
    }
</script>

<script>
    var calendar;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('CalendarWeb');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 500,
            headerToolbar: {
                start: 'today, prev,next',
                center: 'title',
                end: 'dayGridMonth, timeGridWeek, timeGridDay, listWeek,listDay'
            },
            dateClick: function(info) {
                //alert('Date: ' + info.dateStr);
                //alert('Resource ID: ' + info.view.type);
                // $("#exampleModal").modal('show');
            },
            events: 'http://localhost/ERP_Control_Ausencias_Colombian_Absent/eventos.php',
            eventClick: function(info) {
                console.log(info)
                $("#tituloEvento").html(info.event.title);
                $("#cod_ausencias").html(info.event.extendedProps.cod_ausencias);
                $("#nombre_empleado").html(info.event.extendedProps.primer_nombre + ' ' + info.event.extendedProps.segundo_nombre + ' ' + info.event.extendedProps.primer_apellido + ' ' + info.event.extendedProps.segundo_apellido);
                $("#cedula").html(info.event.extendedProps.cedula);
                $("#tipo").html(info.event.extendedProps.tipo);
                $("#fechaInicio").html(info.event.extendedProps.fecha_inicial);
                $("#fechaFinal").html(info.event.extendedProps.fecha_final);
                $("#dias").html(info.event.extendedProps.dias);
                $("#exampleModal").modal('show');
            }

        });
        calendar.setOption('locale', 'es');
        calendar.render();
    });
</script>
<!-- <script>
$(document).ready(function(){
    $('#CalendarWeb1').fullCalendar();
})
</script> -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloEvento"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <div id="descripcionEvento"> </div> -->
                <div class="row">
                    <div class="group col-md-6">
                        <label class="">Cedula: </label> <br />
                        <label for="" id="cedula"></label>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Nombre empleado: </label><br />
                        <label for="" id="nombre_empleado"></label>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="group col-md-6">
                        <label>Codigo ausencia: </label> <br />
                        <label for="" id="cod_ausencias"></label><br />
                    </div>
                    <div class="group col-md-6">
                        <label>Tipo:</label> <br />
                        <label for="" id="tipo"></label><br />
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="group col-md-4">
                        <label>Fecha Inicio:</label> <br />
                        <label for="" id="fechaInicio"></label><br />
                    </div>
                    <div class="group col-md-4">
                        <label>Fecha final: </label> <br />
                        <label for="" id="fechaFinal"></label><br />
                    </div>
                    <div class="group col-md-4">
                        <label>Dias:</label> <br />
                        <label for="" id="dias"></label><br />
                    </div>
                </div>
                <br />
                <div class="group">
                    <label>Descripción: </label> <br />
                    <label for="" id="descripcionEvento"></label><br />
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" id="btnAprobar" class="btn btn-success" data-bs-dismiss="modal">Aprobar</button>
                <button type="button" id="btnRechazar" class="btn btn-danger" data-bs-dismiss="modal">Rechazar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<script>
    var nuevoEvento = {
        id: '2',
    }
    $('#btnAprobar').click(function() {
        alert();
        var id = document.getElementById("cod_ausencias").innerHTML;
        enviarInfo('aprobar', id)
    });
    $('#btnRechazar').click(function() {
        alert();
        var id = document.getElementById("cod_ausencias").innerHTML;
        enviarInfo('rechazar', id)
    });

    function enviarInfo(accion, id) {
        $.ajax({
            type: "POST",
            url: 'eventos.php?accion=' + accion + '&id=' + id,
            success: function(msg) {
                if (msg) {
                    calendar.refetchEvents();
                }
            },
            error: function(msg) {
                alert(msg);
            }
        })
    }
</script>


<section id="Solicitud">
    <div class="Contenido">
        <button onclick="myFunction()" class="btn btn-outline-primary" style="width:180px; font-size: 70.5%;">Vista en formato tabla</button>
        <br />
        <br />
        <section id="Contenedor_Administrar_Historial" style="display: none">
            <h2><i class="fas fa-tasks"></i> Solicitudes de ausencias</h2>
            <form action="Buscar_Solicitudes_Ausencias_Administrador.php" method="get" class="Formulario_Buscador">
                <input type="text" name="Buscador" id="Buscador" placeholder="Buscar" class="Input_Buscador_Solicitudes_Ausencias">
                <input type="submit" value="Buscar" class="Btn_Buscador">
            </form>
            <table>
                <tr>
                    <th>Foto</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Tipo de ausencia</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
                <?php

                $Query_Cantidad_Registros = mysqli_query($conexion, "SELECT COUNT(*) as Total_Registros FROM historial_ausencias INNER JOIN ausencias ON ausencias.cod_ausencias = historial_ausencias.cod_ausencias WHERE ausencias.cod_Estado = 3");
                $Resultado_Cantidad_Registros = mysqli_fetch_array($Query_Cantidad_Registros);
                $Total_Cantidad_Registros = $Resultado_Cantidad_Registros['Total_Registros'];
                $Total_Registros_Por_Pagina = 15;
                if (empty($_GET['Pagina'])) {
                    $Pagina = 1;
                } else {
                    $Pagina = $_GET['Pagina'];
                }
                $Desde = ($Pagina - 1) * $Total_Registros_Por_Pagina;
                $Total_Paginas = ceil($Total_Cantidad_Registros / $Total_Registros_Por_Pagina);
                $Busqueda_Tabla_Historial_Ausencias = mysqli_query($conexion, "SELECT H_A.cod_historial_ausencias as Codigo, U.cedula, U.primer_nombre, U.segundo_nombre, U.primer_apellido, U.segundo_apellido, U.imagen, au.fecha, Tipo_au.nombre_tipo_ausencias as tipo, Es.nombre as Estado from historial_ausencias H_A INNER JOIN usuario U ON H_A.cedula = U.cedula INNER JOIN ausencias au ON H_A.cod_ausencias = au.cod_ausencias INNER JOIN tipo_ausencias Tipo_au ON au.cod_tipo_ausencias = Tipo_au.cod_tipo_ausencias INNER JOIN tipo_estado Es ON Es.cod_Estado = au.cod_Estado WHERE au.cod_Estado = 3 order BY au.fecha Limit $Desde,$Total_Registros_Por_Pagina");
                $Resultado_Tabla = mysqli_num_rows($Busqueda_Tabla_Historial_Ausencias);
                if ($Resultado_Tabla > 0) {
                    while ($Datos_Tabla = mysqli_fetch_array($Busqueda_Tabla_Historial_Ausencias)) {
                ?>
                        <!-- No funcionan las funciones onMouseOver y onMouseOut, intentar hacerlas funcionar -->
                        <tr style="cursor: pointer;" id="fila_<? echo $Datos_Tabla['Codigo']; ?>" onClick="CrearEnlace('Verificar_Ausencia_Administrador.php?id=<?php echo $Datos_Tabla["Codigo"]; ?>');">
                            <td><img src="<?php echo $Datos_Tabla["imagen"]; ?>" alt="" class="Foto_Trabajadores_Tabla_Ausencias"></td>
                            <td><?php echo $Datos_Tabla["cedula"]; ?></td>
                            <td><?php echo $Datos_Tabla["primer_nombre"], " ", $Datos_Tabla["segundo_nombre"], " ", $Datos_Tabla["primer_apellido"], " ", $Datos_Tabla["segundo_apellido"]; ?></td>
                            <td><?php echo $Datos_Tabla["tipo"]; ?></td>
                            <td><?php echo $Datos_Tabla["fecha"]; ?></td>
                            <td class="Tabla_Solicitudes_Columna_Estado_Pendiente">
                                <?php echo $Datos_Tabla["Estado"]; ?>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
            <?php
            if ($Total_Cantidad_Registros != 0) {
            ?>
                <div class="Paginador_Administrador_Tabla">
                    <ul>
                        <?php
                        if ($Pagina != 1) {
                        ?>
                            <li><a href="?Pagina=<?php echo 1; ?>">|<< /a>
                            </li>
                            <li><a href="?Pagina=<?php echo $Pagina - 1; ?>">
                                    <<< /a>
                            </li>
                        <?php
                        }
                        for ($i = 1; $i <= $Total_Paginas; $i++) {
                            if ($i == $Pagina) {
                                echo '<li class="Pagina_Seleccionada">' . $i . '</li>';
                            } else {
                                echo '<li><a href="?Pagina=' . $i . '">' . $i . '</a></li>';
                            }
                        }
                        if ($Pagina != $Total_Paginas) {
                        ?>

                            <li><a href="?Pagina=<?php echo $Pagina + 1; ?>">>></a></li>
                            <li><a href="?Pagina=<?php echo $Total_Paginas; ?>">>|</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            <?php
            }
            ?>
        </section>
        <div class="container" id="idCalendar" style="font-size: 70.5%;">
            <div calss="row" >
                <div class="col"> </div>
                <div class="col-8">
                    <div id="CalendarWeb"> </div>
                </div>
                <div class="col"> </div>
            </div>
        </div>
</section>

</div>

<?php include_once 'Modulos/Templates/Footer_Admin.php'; ?>