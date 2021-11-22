<?php include_once 'Modulos/Templates/header.php';
include "Configuraciones/Funciones.php";
?>

<!-- <link href='CSS/main.cs' rel='stylesheet' />
<script src='js/main.js'></script> -->


<script src="js/main.js"></script>
<script src="js/main.min.js"></script>
<link rel="stylesheet" type="text/css" href="CSS/main.css">
<link rel="stylesheet" type="text/css" href="CSS/main.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/es.js"></script>

<button onclick="myFunction()">Vista calendario</button>

<div id="idDiv" style="display: none"> Hola</div>
<div class="container" id="idCalendar">
    <div calss="row">
        <div class="col"> </div>
        <div class="col-7">
            <div id="CalendarWeb"> </div>
        </div>
        <div class="col"> </div>
    </div>
</div>

<script>
function myFunction() {
    var x = document.getElementById("idCalendar");
    var y = document.getElementById("idDiv");
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
    <?php include_once 'Modulos/Templates/footer.php'; ?>