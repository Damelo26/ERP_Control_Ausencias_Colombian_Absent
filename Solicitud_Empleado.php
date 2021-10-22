<?php include_once 'Modulos/Templates/header.php';
include "Configuraciones/Funciones.php";

$dato = '';
$cedula = $_SESSION['cedula'];
$query = mysqli_query($conexion, "SELECT (c.nombre_cargo) as job, (u.correo) as email FROM usuario u INNER JOIN cargo c on c.cod_cargo = u.cod_cargo where u.cedula = $cedula LIMIT 1;");
$result = mysqli_num_rows($query);
if ($result > 0) {
    $dato = mysqli_fetch_array($query);
}
if (!empty($_POST)) {
    if (!isset($_SESSION)) {
        session_start();
    }
    $alerta = '';
    $nombre = $_FILES['archivo']['name'];
    if ($nombre != '') {
        $directorio = "archivos/";
        $archivo = $directorio . basename($_FILES["archivo"]["name"]);
        $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
        if ($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" || $tipoArchivo == "png" || $tipoArchivo == "pdf") {
            $nombre_temporal = $_FILES['archivo']['tmp_name'];
            if (move_uploaded_file($nombre_temporal, $archivo)) {
                $descripcion = $_POST['descripcion'];
                $tipos_ausenias = $_POST['tipos_ausenias'];
                $fecha_inicio = $_POST['fecha_inicio'];
                $newDate = date("Y-m-d", strtotime($fecha_inicio));
                $dias_ausente = $_POST['xfecha'];
                $cod_estado = 3;
                $query_insert = mysqli_query($conexion, "INSERT INTO ausencias(fecha,documento,descripcion,dias_ausentes,cod_tipo_ausencias,cod_Estado) VALUES ('$newDate','$archivo','$descripcion','$dias_ausente','$tipos_ausenias','$cod_estado');");
                if ($query_insert) {
                    $alerta_type = 'success';
                    $alerta_titulo = 'Solicitud satisfactoria';
                    $alerta = 'La solicitud de ausencia se almacenó correctamente';
                } else {
                    $alerta_type = 'error';
                    $alerta_titulo = 'Solicitud fracasada';
                    $alerta = 'La solicitud de ausencia no almacenó correctamente';
                }
            }
        }
    } else {
        $alerta_type = 'error';
        $alerta_titulo = 'Solicitud fracasada';
        $alerta = 'Debe cargar un archivo que valide su ausencia';
    }
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="main.js"></script>
<script>
    /*
    $(function() {
        var from = $("#fromDate")
            .datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true
            })
            .on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
            to = $("#toDate").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true
            })
            .on("change", function() {
                from.datepicker("option", "maxDate", getDate(this));
            });

        function getDate(element) {
            var date;
            var dateFormat = "yy-mm-dd";
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }
            return date;
        }
    });
    */
    $(function() {
        var $datepicker1 = $("#datepicker1");
        var $datepicker2 = $("#datepicker2");
        var $datepicker3 = $("#datepicker3");
        var $date;
        var $date_two;
        $('#datepicker1').datepicker({
            dateFormat: 'dd-mm-yy',
            onSelect: function(fecha) {
                $datepicker2.datepicker({});
                $datepicker2.datepicker("option", "disabled", false);
                $datepicker2.datepicker('setDate', null);
                $datepicker2.datepicker("option", "minDate", fecha);
                $.ajax({
                        url: 'Solicitud_Empleado.php',
                        type: 'POST',
                        data: {
                            fecha: fecha
                        },
                    })
                    .done(function(resultado) {
                        /*$("#xfecha").html(fecha);*/
                        $date = fecha;
                    });

                $('#xfecha').val($date);
            }
        });
        $('#datepicker2').datepicker({
            dateFormat: 'dd-mm-yy',
            onSelect: function(fecha) {
                $.ajax({
                        url: 'Solicitud_Empleado.php',
                        type: 'POST',
                        data: {
                            fecha: fecha
                        },
                    })
                    .done(function(resultado) {
                        $("#xfecha").val(restaFechas($date, fecha));
                        /*alert(fecha);*/
                        $date_two = fecha;
                    });
            }
        });
    });

    function restaFechas(f1, f2) {
        ;
        var aFecha1 = f1.split('-');
        var aFecha2 = f2.split('-');
        var fFecha1 = Date.UTC(aFecha1[2], aFecha1[1] - 1, aFecha1[0]);
        var fFecha2 = Date.UTC(aFecha2[2], aFecha2[1] - 1, aFecha2[0]);
        var dif = fFecha2 - fFecha1;
        var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
        return (dias + 1);
    }
</script>
<div class="body_solicitud">
    <section class="izquierdo_solicitud">
        <label>Gestion de procesos</label>
        </label><a class="button_izquierdo" href="Solicitud_Empleado.php"> Realizar solicitud </a>
    </section>
    <section class="derecho_solicitud">
        <form id="form_subir" enctype="multipart/form-data" action="Solicitud_Empleado.php" method="POST" class="form_solicitud">

            <div class="division_from_solicitud">
                <label class="form_izquierda">Descripción</label>
                <textarea name="descripcion" id="" cols="5" rows="5" class="form_derecha entrada" style="height: 50px;" placeholder="Descripción" type="text" required></textarea>
            </div>
            <div class="division_from_solicitud">
                <label for="Tipo de ausencias" class="form_izquierda">Tipo de ausencias</label>
                <?php
                $query_ausencia = mysqli_query($conexion, "SELECT * FROM tipo_ausencias ORDER BY nombre_tipo_ausencias ASC");
                $result_ausencia = mysqli_num_rows($query_ausencia);
                ?>
                <select id="Ausencia" name=tipos_ausenias class="form_derecha color_formas">
                    <?php
                    if ($result_ausencia > 0) {
                        while ($Ausencia = mysqli_fetch_array($query_ausencia)) {
                    ?>
                            <option value="<?php echo $Ausencia["cod_tipo_ausencias"]; ?>">
                                <?php echo $Ausencia["nombre_tipo_ausencias"] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="division_from_solicitud">
                <label class="form_izquierda"> Correo electrónico: </label>
                <label class="form_derecha">
                    <label><?php echo $dato['email'] ?>
                    </label>
                </label>
            </div>
            <div class="division_from_solicitud">
                <label class="form_izquierda">Cargo</label>
                <label class="form_derecha">
                    <label><?php echo $dato['job'] ?>
                    </label>
                </label>
            </div>
            <div class="division_from_solicitud">
                <p class="form_izquierda"></p>
                <p class="form_izquierda">Inicio solicitud: <input name="fecha_inicio" type="text" class="datepicker form_derecha espacio_solicitud color_formas" id="datepicker1" required></p>
                <p class="form_izquierda">Fin solicitud: <input type="text" class="datepicker form_derecha espacio_solicitud color_formas" id="datepicker2" disabled required></p>

            </div>
            <div class="division_from_solicitud">
                <label for="" class="form_izquierda">Dias de ausencia:</label>
                <input name="xfecha" id="xfecha" class="form_derecha" type="text" readonly />
            </div>
            <div class="division_from_solicitud">
                <label for="" class="form_izquierda bajar_texto">Archivo a subir:</label>
                <input type="file" name="archivo" id="archivo" class="form_derecha file_input" required />
            </div>
            <div class="division_from_solicitud centrar bajar_texto">
                <p class="form_izquierda"></p>
                <button type="submit" class="button_derecho"> Enviar </button>
                <button type="button" class="button_derecho" id="cancelar" value="Cancelar"> Cancelar </button>
            </div>

        </form>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"> </script>
<script type="text/javascript">
    var opciones = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "showDuration": "3000",
        "hideDuration": "3000",
        "timeOut": "3000",
        "extendedTimeOut": "3000",
        "preventDuplicates": true,
    }

    if ('<?php echo ($alerta_type) ?>' == 'error') {
        toastr.error('<?php echo isset($alerta) ? $alerta : '' ?>', '<?php echo isset($alerta_titulo) ? $alerta_titulo : '' ?>', opciones);


    } else {
        toastr.success('<?php echo isset($alerta) ? $alerta : '' ?>', '<?php echo isset($alerta_titulo) ? $alerta_titulo : '' ?>', opciones);

    }
</script>


<?php include_once 'Modulos/Templates/footer.php'; ?>