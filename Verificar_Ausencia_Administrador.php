<?php include_once 'Modulos/Templates/Header_Admin.php'; ?>
<?php
include "Configuraciones/Funciones.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
$cuerpo_mensaje= '';

if (empty($_GET['id'])){
    header('Location: Admin.php');
}
$ID_Solicitud = $_GET['id'];
if (!empty($_GET['estado'])) { //Actualiza el nuevo estado de la solicitud
    $ID_Estado = $_GET['estado'];
    if($ID_Estado == 1){
        $Estado_Correo = "Aprobado";
       $cuerpo_mensaje="Hola! Desde colombia Absent te damos a conocer que tu solicitud está actualmente aprobada";
    }elseif($ID_Estado == 2){
        $Estado_Correo = "Rechazado";
        $cuerpo_mensaje="Hola! Desde colombia Absent te damos a conocer que tu solicitud está actualmente rechazada";
    }elseif($ID_Estado == 3){
        $Estado_Correo = "Pendiente";
       
    }
    $query_update = mysqli_query($conexion, "UPDATE ausencias INNER JOIN historial_ausencias H ON ausencias.cod_ausencias = H.cod_ausencias SET ausencias.cod_Estado = '$ID_Estado' WHERE H.cod_historial_ausencias = '$ID_Solicitud'");
    $query = mysqli_query($conexion, "SELECT H_A.cod_historial_ausencias as Codigo, U.cedula, U.primer_nombre, U.segundo_nombre, U.primer_apellido, U.segundo_apellido,U.imagen, U.direccion, U.numero_celular as celular, U.correo as email, au.fecha, au.documento, au.descripcion, au.dias_ausentes, Tipo_au.nombre_tipo_ausencias as tipo, c.nombre_cargo as cargo, Es.cod_Estado, Es.nombre as estado from historial_ausencias H_A INNER JOIN usuario U ON H_A.cedula = U.cedula INNER JOIN ausencias au ON H_A.cod_ausencias = au.cod_ausencias INNER JOIN tipo_ausencias Tipo_au ON au.cod_tipo_ausencias = Tipo_au.cod_tipo_ausencias INNER JOIN cargo c on c.cod_cargo = U.cod_cargo INNER JOIN tipo_estado Es ON Es.cod_Estado = au.cod_Estado WHERE H_A.cod_historial_ausencias = $ID_Solicitud");
    $result = mysqli_num_rows($query);
    if($result>0){
    $Datos_Solicitud = mysqli_fetch_array($query);
 }   
 
    if ($query_update) {
        $alerta_type = 'success';
        $alerta_titulo = 'Actualización satisfactoria';
        $alerta = 'La actualización de la solicitud fue satisfactoria';
        $mail = new PHPMailer(true);
     
        try {
           
            $mail->SMTPDebug = 0;                      
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'colombiabsent@gmail.com';                     
            $mail->Password   = 'colombia1234.';                               
            $mail->SMTPSecure = 'tls';            
            $mail->Port       = 587;                                    
            $mail->setFrom('colombiabsent@gmail.com', 'Colombia Absent');
            $mail->addAddress($Datos_Solicitud['email']);    
            $mail->isHTML(true);                                 
            $mail->Subject = 'Estado de la solicitud de ausencia';
            $mail->Body    = $cuerpo_mensaje;
            $mail->send();
           
        } catch (Exception $e) {
            
        }
    } else {
        $alerta_type = 'error';
        $alerta_titulo = 'Actualización fracasada';
        $alerta = 'La actualización de la solicitud no fue posible';
    }
} else {
    $alerta_type = 'error';
    $alerta_titulo = 'Actualización fracasada';
    $alerta = 'Estado de solicitud invalido';
}
$Info_Solicitud_Ausencia = mysqli_query($conexion, "SELECT H_A.cod_historial_ausencias as Codigo, U.cedula, U.primer_nombre, U.segundo_nombre, U.primer_apellido, U.segundo_apellido,U.imagen, U.direccion, U.numero_celular as celular, U.correo, au.fecha, au.documento, au.descripcion, au.dias_ausentes, Tipo_au.nombre_tipo_ausencias as tipo, c.nombre_cargo as cargo, Es.cod_Estado, Es.nombre as estado from historial_ausencias H_A INNER JOIN usuario U ON H_A.cedula = U.cedula INNER JOIN ausencias au ON H_A.cod_ausencias = au.cod_ausencias INNER JOIN tipo_ausencias Tipo_au ON au.cod_tipo_ausencias = Tipo_au.cod_tipo_ausencias INNER JOIN cargo c on c.cod_cargo = U.cod_cargo INNER JOIN tipo_estado Es ON Es.cod_Estado = au.cod_Estado WHERE H_A.cod_historial_ausencias = $ID_Solicitud");
$Resultado_Solicitud = mysqli_num_rows($Info_Solicitud_Ausencia);
if ($Resultado_Solicitud == 0) {
    header('Location: Solicitudes_Ausencias_Admin.php'); //Tratar de optimizar para todos ÁUN LE FALTA
} else {
    $Datos_Solicitud = mysqli_fetch_array($Info_Solicitud_Ausencia);
}

?>
<section id="Aprobar">
    <div class="Contenido">
        <?php
        if ($Datos_Solicitud["estado"] === "Pendiente") {
        ?>
            <h1>Solicitud pendiente</h1>
        <?php
        } elseif ($Datos_Solicitud["estado"] === "Rechazado") {
        ?>
            <h1>Solicitud rechazada</h1>
        <?php
        } elseif ($Datos_Solicitud["estado"] === "Aprobado") {
        ?>
            <h1>Solicitud aprobada</h1>
        <?php
        }
        ?>
        <div class="grid">
            <div class="Foto_Usuario_Solicitud">
                <!--HAY QUE HACER QUE LA FOTO SE ADAPTE AL TAMAÑO DE LA PÁGINA-->
                <img src="<?php echo $Datos_Solicitud["imagen"]; ?>" alt="" class="Circunferencia_Foto_Usuario_Solicitud">
            </div>
            <div class="Nombre_Usuario_Solicitud">
                <label for="Nombre">Nombre</label>
                <p><?php echo $Datos_Solicitud["primer_nombre"], " ", $Datos_Solicitud["segundo_nombre"], " ", $Datos_Solicitud["primer_apellido"], " ", $Datos_Solicitud["segundo_apellido"]; ?></p>
            </div>
            <div class="Cedula_Usuario_Solicitud">
                <label for="Cedula">Cédula</label>
                <p><?php echo $Datos_Solicitud["cedula"]; ?></p>
            </div>
            <div class="Fecha_Usuario_Solicitud">
                <label for="Fecha">Fecha de solicitud</label>
                <p><?php echo $Datos_Solicitud["fecha"]; ?></p>
            </div>
            <div class="Estado_Usuario_Solicitud">
                <label for="Estado">Estado</label>
                <?php
                if ($Datos_Solicitud["estado"] === "Pendiente") {
                ?>
                    <p class="P_Estado_Pendiente"><?php echo $Datos_Solicitud["estado"]; ?></p>
                <?php
                } elseif ($Datos_Solicitud["estado"] === "Rechazado") {
                ?>
                    <p class="P_Estado_Rechazado"><?php echo $Datos_Solicitud["estado"]; ?></p>
                <?php
                } elseif ($Datos_Solicitud["estado"] === "Aprobado") {
                ?>
                    <p class="P_Estado_Aprobado"><?php echo $Datos_Solicitud["estado"]; ?></p>
                <?php
                }
                ?>
            </div>
            <div class="Cargo_Usuario_Solicitud">
                <label for="Cargo">Cargo laboral</label>
                <p><?php echo $Datos_Solicitud["cargo"]; ?></p>
            </div>
            <div class="Tipo_Usuario_Solicitud">
                <label for="Tipo_Ausencia">Tipo de ausencia</label>
                <p><?php echo $Datos_Solicitud["tipo"]; ?></p>
            </div>
            <div class="Dias_Usuario_Solicitud">
                <label for="Dias">Días de permiso</label>
                <p><?php echo $Datos_Solicitud["dias_ausentes"]; ?></p>
            </div>
            <div class="Descripcion_Usuario_Solicitud">
                <label for="descripcion">Descripción de la ausencia</label>
                <p><?php echo $Datos_Solicitud["descripcion"]; ?></p>
            </div>
            <div class="Celular_Usuario_Solicitud">
                <label for="Celular">Número de contacto</label>
                <p><?php echo $Datos_Solicitud["celular"]; ?></p>
            </div>
            <div class="Email_Usuario_Solicitud">
                <label for="Email">Correo electronico</label>
                <p><?php echo $Datos_Solicitud["correo"]; ?></p>
            </div>
            <div class="Direccion_Usuario_Solicitud">
                <label for="direccion">Dirección de residencia</label>
                <p><?php echo $Datos_Solicitud["direccion"]; ?></p>
            </div>
            <div class="Documento_Usuario_Solicitud">
                <div class="Boton_Para_Documentos_Ausencias">
                    <a href="<?php echo $Datos_Solicitud["documento"]; ?>" target="_blank"><i class="far fa-file-alt"></i> Documentos de soporte</a>
                </div>
            </div>
            <?php
            if ($Datos_Solicitud["estado"] === "Pendiente") {
            ?>
                <div class="Opcion_Aprobar_Usuario_Solicitud">
                    <a href="Verificar_Ausencia_Administrador.php?id=<?php echo $ID_Solicitud; ?>&estado=1"><i class="fas fa-check"></i> Aprobar</a>
                </div>
                <div class="Opcion_Rechazar_Usuario_Solicitud">
                    <a href="Verificar_Ausencia_Administrador.php?id=<?php echo $ID_Solicitud; ?>&estado=2"><i class="fas fa-times"></i> Rechazar</a>
                </div>

            <?php
            } elseif ($Datos_Solicitud["estado"] === "Rechazado") {
            ?>
                <div class="Opciones_Usuario_Solicitud">
                    <div class="Opcion_Aprobar_Usuario_Solicitud">
                        <a href="Verificar_Ausencia_Administrador.php?id=<?php echo $ID_Solicitud; ?>&estado=1"><i class="fas fa-check"></i> Aprobar</a>
                    </div>
                </div>
            <?php
            } elseif ($Datos_Solicitud["estado"] === "Aprobado") {
            ?>
                <div class="Opciones_Usuario_Solicitud">
                    <div class="Opcion_Rechazar_Usuario_Solicitud">
                        <a href="Verificar_Ausencia_Administrador.php?id=<?php echo $ID_Solicitud; ?>&estado=2"><i class="fas fa-times"></i> Rechazar</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
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
</section>
<?php include_once 'Modulos/Templates/Footer_Admin.php'; ?>