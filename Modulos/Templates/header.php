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
<html>

<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="img/logo.png">
	<link rel="stylesheet" type="text/css" href="CSS/EstiloLogin.css">
	<link rel="stylesheet" href="CSS/Estilo.css">
	<link rel="stylesheet" href="CSS/Styleslider.css">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300;1,400&family=Oswald:wght@200;300;400;500;600;700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<title>Colombian Absent</title>
	<link rel="stylesheet" href="CSS/normalize.css">
	<!--Esta libreria es importante ya que nos hara que en todo lado el cod se vea igual /Lo normaliza/-->
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<!--Desde aqui agregue-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script>
		function enableSending() {
			document.Formulario_Registro_Usuario.submit.disabled = !document.Formulario_Registro_Usuario.checkbox.checked;
		}
	</script>

</head>

<body>
	<div class="Alinear_Header">
		<header class="header">
			<figure>
				<img src="img/logo.png" alt="">
			</figure>
			<p class="tamanoTitulo">COLOMBIA ABSENT</p>
			<div class="perfil">
				<div class="imagen">
					<img src="<?php echo $imagen; ?>">
				</div>
				<div class="Info_Perfil">
					<p>Bienvenido</p>
					<?php
					if (strcmp($usuario, "Invitado")) {
					?>
						<a href="Actualizar_Usuario_Pets_Home.php" class="Perfil_Nombre"><?php echo $usuario; ?></a>
					<?php
					} else {
					?>
						<p class="Perfil_Nombre"><?php echo $usuario; ?></p>
					<?php
					}
					?>
				</div>
			</div>
		</header>
	</div>
	<div class="menu">
		<a class="centrar_header" href="index.php"><i class="fas fa-home"></i> Principal</a>
		<a href="Login.php"><i class="fas fa-user"></i> Iniciar sesión</a>
		<a href="Modulos/Exit.php"><i class="fas fa-times-circle"></i> Salir</a>
	</div>
	</div>