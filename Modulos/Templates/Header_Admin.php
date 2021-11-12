<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Colombia Absent</title>
    <link rel="stylesheet" href="CSS/EstiloAdmin.css">
    <link rel="stylesheet" href="CSS/EstiloLogin.css">
    <link rel="stylesheet" href="CSS/EstiloRegistrarUsu.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="js/Seleccionar_Filas.js"></script>
    <script>
        $(document).ready(function() {
            $(".menu_derecho li .fas").click(function() {
                $(".menu_perfil").toggleClass("active");
            });
            $(".Barra_Nav").click(function() {
                $(".Envoltura").toggleClass("active");
            })
        })
    </script>
    <!-- El siguiente Script es para resaltar las filas de las tablas de todas las solicitudes y seleccionarlas -->
    <script langiage="javascript" type="text/javascript">
        // CONVERTIR LAS FILAS EN LINKS POR CADA SOLICITUD DE AUSENCIA
        function CrearEnlace(url) {
            location.href = url;
        }
    </script>
</head>
<div class="Envoltura">
    <div class="Top">
        <div class="Barra_Nav">
            <div class="Contenido_Barra">
                <div class="Linea_Uno"></div>
                <div class="Linea_Dos"></div>
                <div class="Linea_Tres"></div>
            </div>
        </div>
        <div class="menuadmin">
            <a href="index.php">
                <div class="logo">
                    Colombia Absent
                </div>
            </a>
            <div class="c">
                <ul>
                    <li><i class="fas fa-user-circle"></i> <!-- Este es el muñequito -->
                        <div class="menu_perfil">
                            <div class="item_menu_perfil"><a href="Modulos/Exit.php">Salir</a></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <body>

        <div class="Objeto_Contenedor">

            <div class="Barra_Deslizadora">
                <div class="Barra_Deslizadora_Interna">
                    <div class="perfil">
                        <div class="imagen">
                            <!--esto es temporal !-->
                            <?php
                            if (!isset($_SESSION)) {
                                session_start();
                            }
                            if (!isset($_SESSION['ID_Rol'])) {
                                $imagen = "img/Imagenes_Perfil/logo_perfil.png";
                                $usuario = "Invitado";
                            } else {
                                if ($_SESSION['ID_Rol'] > 0) {
                                    $usuario = $_SESSION['Primer_Nombre'] . " " . $_SESSION['Primer_Apellido'];
                                    $imagen = $_SESSION['Imagen'];
                                }
                            }
                            ?>
                            <!-- <img src = "<?php echo $_SESSION['Imagen']; ?>" alt = "profile_pic">
                            !-->
                        </div>
                        <div class="Info_Perfil">
                            <p>Bienvenido(a)</p>
                            <p class="Perfil_Nombre">
                                <?php
                                $datos_usuario = file_get_contents("././usuario.json");
                                $json_usuario = json_decode($datos_usuario, true);
                                echo $json_usuario["primer_nombre"] . " " . $json_usuario["primer_apellido"];
                                ?>
                            </p>
                            </p>
                        </div>
                    </div>
                    <ul>
                        <li>
                            <a href="Registrar_Usuario.php" class="active">
                                <span class="icon"><i class="fas fa-chart-bar"></i></span>
                                <span class="titulo">Registrar usuario</span>
                            </a>
                        </li>
                        <li>
                            <a href="Solicitudes_Ausencias_Admin.php">
                                <span class="icon"><i class="fas fa-envelope-open-text"></i> </span>
                                <span class="titulo">Solicitudes</span>
                            </a>
                        </li>
                        <li>
                            <a href="Historial_Solicitudes_Admin.php">
                                <span class="icon"><i class="fas fa-folder-open"></i> </span>
                                <span class="titulo">Historial</span>
                            </a>
                        </li>
                        <li>
                            <a href="Solicitudes_Aprobadas_Admin.php">
                                <span class="icon"><i class="fas fa-clipboard-check"></i> </span>
                                <span class="titulo">Aprobados</span>
                            </a>
                        </li>
                        <li>
                            <a href="Solicitudes_Rechazadas_Admin.php">
                                <span class="icon"><i class="fas fa-times-circle"></i> </span>
                                <span class="titulo">Rechazados</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>