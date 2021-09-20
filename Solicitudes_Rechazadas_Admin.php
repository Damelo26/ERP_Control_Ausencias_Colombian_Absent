<?php include_once 'Modulos/Templates/Header_Admin.php'; ?>

<div class="Contenido">
    <section id="Contenedor_Administrar_Historial">
        <h2><i class="fas fa-times-circle"></i> Ausencias rechazadas</h2>
        <form action="Buscar_Solicitudes_Ausencias_Administrador.php" method="get" class="Formulario_Buscador">
            <input type="text" name="Buscador" id="Buscador" placeholder="Buscar">
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
            include "Configuraciones/Funciones.php";
            $Query_Cantidad_Registros = mysqli_query($conexion, "SELECT COUNT(*) as Total_Registros FROM historial_ausencias INNER JOIN ausencias ON ausencias.cod_ausencias = historial_ausencias.cod_ausencias WHERE ausencias.cod_Estado = 2");
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
            $Busqueda_Tabla_Historial_Ausencias = mysqli_query($conexion, "SELECT H_A.cod_historial_ausencias as Codigo, U.cedula, U.primer_nombre, U.segundo_nombre, U.primer_apellido, U.segundo_apellido, U.imagen, au.fecha, Tipo_au.nombre_tipo_ausencias as tipo, Es.nombre as Estado from historial_ausencias H_A INNER JOIN usuario U ON H_A.cedula = U.cedula INNER JOIN ausencias au ON H_A.cod_ausencias = au.cod_ausencias INNER JOIN tipo_ausencias Tipo_au ON au.cod_tipo_ausencias = Tipo_au.cod_tipo_ausencias INNER JOIN tipo_estado Es on Es.cod_Estado = au.cod_Estado WHERE au.cod_Estado = 2 order BY au.fecha Limit $Desde,$Total_Registros_Por_Pagina");
            $Resultado_Tabla = mysqli_num_rows($Busqueda_Tabla_Historial_Ausencias);
            if ($Resultado_Tabla > 0) {
                while ($Datos_Tabla = mysqli_fetch_array($Busqueda_Tabla_Historial_Ausencias)) {
            ?>
                    <tr>
                        <td><img src="<?php echo $Datos_Tabla["imagen"]; ?>" alt="" class="Foto_Trabajadores_Tabla_Ausencias"></td>
                        <td><?php echo $Datos_Tabla["cedula"]; ?></td>
                        <td><?php echo $Datos_Tabla["primer_nombre"], " ", $Datos_Tabla["segundo_nombre"], " ", $Datos_Tabla["primer_apellido"], " ", $Datos_Tabla["segundo_apellido"]; ?></td>
                        <td><?php echo $Datos_Tabla["tipo"]; ?></td>
                        <td><?php echo $Datos_Tabla["fecha"]; ?></td>
                        <td>
                            <!--<a href="Verificar_Ausencia_Administrador.php?id=<?php //echo $Datos_Tabla["Codigo"]; 
                                                                                    ?>" class="Link_Verificar_Ausencia">Verificar</a>
                   <a href="Aprobar_Ausencia_Administrador.php?id=<?php //echo $Datos_Tabla["Codigo"]; 
                                                                    ?>" class="Link_Aprobar_Ausencia">Aprobar </a>
                  <a href="Rechazar_Ausencia_Administrador.php?id=<?php //echo $Datos_Tabla["Codigo"]; 
                                                                    ?>" class="Link_Rechazar_Ausencia">Rechazar</a> -->
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
</div>

<?php include_once 'Modulos/Templates/Footer_Admin.php'; ?>