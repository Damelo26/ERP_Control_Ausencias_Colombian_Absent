<?php include_once 'Modulos/Templates/header.php';
include "Configuraciones/Funciones.php"; 




?>

<div class="body_solicitud">
    <section class="izquierdo_solicitud">
        <label>Gestion de procesos</label>
        <button type="submit" class="button_izquierdo"> Realizar solicitud </button>
        <label>Historial de solicitudes</label>
        <button type="submit" class="button_izquierdo"> Solicitudes en espera </button>
        <button type="submit" class="button_izquierdo"> Solicitudes aprobadas </button>
        <button type="submit" class="button_izquierdo"> Solicitudes rechazadas </button>
    </section>
    <section class="derecho_solicitud">
     <div>
         <p>{Fecha y Hora}</p>
        <p><strong>Hola {name}, ¿Que gestión deseas hacer hoy?</strong></p>
        <p>En la parte izquierda encontrarás los siguentes procesos:</p>
        <ul>
            <li>Realizar una solicitud: En la cual se podrá gestionar una solicitud de ausencia de un tipo especifico.</li>
            <li>Solicitudes en espera: Podrá verificar las solicitudes que se están en espera</li>
            <li>Solicitudes aprobadas: Podrá verificar las solicitudes que están aceptadas</li>
            <li>Solicitudes rechazadas: Podrá verificar las solicitudes que están rechazadas</li>
        </ul>
        
     </div>  
     <label name="xfecha" id="xfecha"> </label>
    </section>
</div>


<?php include_once 'Modulos/Templates/footer.php'; ?>