<?php include_once 'Modulos/Templates/Header_Admin.php';?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <tittle> </tittle>
        <meta name="viewport" content="width=device-width, user-scalable=yes, inicial-scale=1.0,
        maximum-scale=3.0, minimum-scale=1.0">
        <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <link ref="stylesheet" href="EstiloRegistrarUsu.css">

</head>
<body>
    <form class="formulario_usuario">
        <h1> Registra a tu usuario </h1>
       
        <div class="contenedor_usu">
        <div class="input-contenedor_usu">
        
<input type="text"  class="entrada" placeholder="Cédula">
            </div>
            <div class="input-contenedor_usu">
           
<input type="text"  class="entrada" placeholder="Primer nombre">
            </div>
            <div class="input-contenedor_usu">
         
<input type="text" class="entrada" placeholder="Segundo nombre">
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
<input type="text" class="entrada" placeholder="Primer apellido">
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
<input type="text" class="entrada" placeholder="Segundo apellido">
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
<input type="text" class="entrada" placeholder="Dirección">
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
<input type="text" class="entrada" placeholder="Numero de celular">
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
<input type="text" class="entrada" placeholder="Correo">
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
<input type="text" class="entrada" placeholder="Tipo de usuario">
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
<input type="text" class="entrada" placeholder="Cargo">
            </div>
          
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
<input type="password" class="entrada" placeholder="Contraseña">
            </div>
            <input type="submit" value="Registrar" class="botonreg">

</div>
</form>
</body>
</html>
<?php include_once 'Modulos/Templates/Footer_Admin.php';?>