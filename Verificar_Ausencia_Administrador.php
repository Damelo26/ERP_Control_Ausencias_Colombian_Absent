<?php include_once 'Modulos/Templates/Header_Admin.php'; ?>
<?php
include "Configuraciones/Funciones.php";
if (empty($_GET['id'])) {
    header('Location: Admin.php');
}
$ID_Solicitud = $_GET['id'];
$Info_Solicitud_Ausencia = mysqli_query($conexion, "SELECT U.cedula, U.primer_nombre, U.segundo_nombre, U.primer_apellido, U.segundo_apellido,U.imagen, U.direccion, U.numero_celular as celular, U.correo, au.fecha, au.documento, au.descripcion, au.dias_ausentes, Tipo_au.nombre_tipo_ausencias as tipo, c.nombre_cargo as cargo, Es.cod_Estado, Es.nombre as estado from historial_ausencias H_A INNER JOIN usuario U ON H_A.cedula = U.cedula INNER JOIN ausencias au ON H_A.cod_ausencias = au.cod_ausencias INNER JOIN tipo_ausencias Tipo_au ON au.cod_tipo_ausencias = Tipo_au.cod_tipo_ausencias INNER JOIN cargo c on c.cod_cargo = U.cod_cargo INNER JOIN tipo_estado Es ON Es.cod_Estado = au.cod_Estado WHERE H_A.cod_historial_ausencias = $ID_Solicitud");
$Resultado_Solicitud = mysqli_num_rows($Info_Solicitud_Ausencia);
if ($Resultado_Solicitud == 0){
    header('Location: Solicitudes_Ausencias_Admin.php'); //Tratar de optimizar para todos ÁUN LE FALTA
    }else{
        $Datos_Solicitud = mysqli_fetch_array($Info_Solicitud_Ausencia);
}
?>
<div class="Contenido">
    <h1>Solicitud de ausencia</h1>
    <div class="grid">
        <div class="Foto_Usuario_Solicitud">
            <!--HAY QUE HACER QUE LA FOTO SE ADAPTE AL TAMAÑO DE LA PÁGINA-->
            <img src="<?php echo $Datos_Solicitud["imagen"]; ?>" alt="" class="Circunferencia_Foto_Usuario_Solicitud">
        </div>
        <div class="Nombre_Usuario_Solicitud">
            <label for="Nombre">Nombre</label>
            <p><?php echo $Datos_Solicitud["primer_nombre"], " ", $Datos_Solicitud["segundo_nombre"], " ", $Datos_Solicitud["primer_apellido"], " ", $Datos_Solicitud["segundo_apellido"];?></p>
        </div>
        <div class="Cedula_Usuario_Solicitud">
            <label for="Cedula">Cédula</label>
            <p><?php echo $Datos_Solicitud["cedula"];?></p>
        </div>
        <div class="Fecha_Usuario_Solicitud">
            <label for="Fecha">Fecha de solicitud</label>
            <p><?php echo $Datos_Solicitud["fecha"];?></p>
        </div>
        <div class="Estado_Usuario_Solicitud">
            <label for="Estado">Estado</label>
            <p><?php echo $Datos_Solicitud["estado"];?></p>
        </div>
        <div class="Cargo_Usuario_Solicitud">
            <label for="Cargo">Cargo laboral</label>
            <p><?php echo $Datos_Solicitud["cargo"];?></p>
        </div>
        <div class="Tipo_Usuario_Solicitud">
            <label for="Tipo_Ausencia">Tipo de ausencia</label>
            <p><?php echo $Datos_Solicitud["tipo"];?></p>
        </div>
        <div class="Dias_Usuario_Solicitud">
            <label for="Dias">Días de permiso</label>
            <p><?php echo $Datos_Solicitud["dias_ausentes"];?></p>
        </div>
        <div class="Descripcion_Usuario_Solicitud">
            <label for="descripcion">Descripción de la ausencia</label>
            <p><?php echo $Datos_Solicitud["descripcion"];?></p>
        </div>
        <div class="Celular_Usuario_Solicitud">
            <label for="Celular">Número de contacto</label>
            <p><?php echo $Datos_Solicitud["celular"];?></p>
        </div>
        <div class="Email_Usuario_Solicitud">
            <label for="Email">Correo electronico</label>
            <p><?php echo $Datos_Solicitud["correo"];?></p>
        </div>
        <div class="Direccion_Usuario_Solicitud">
            <label for="direccion">Dirección de residencia</label>
            <p><?php echo $Datos_Solicitud["direccion"];?></p>
        </div>
        <div class="Documento_Usuario_Solicitud">
            <label for="documento">Documento de soporte</label>
            <p><?php echo $Datos_Solicitud["documento"];?></p>
        </div>
        <div class="Opciones_Usuario_Solicitud">
            <label for="documento">Aprobar</label>
            <label for="documento">Rechazar</label>
        </div>
    </div>
</div>
<?php include_once 'Modulos/Templates/Footer_Admin.php'; ?>