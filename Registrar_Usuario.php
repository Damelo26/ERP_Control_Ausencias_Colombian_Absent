<?php
include "Configuraciones/Funciones.php";
  if(!empty($_POST)){
	$Register_alert='';
	if (empty($_POST['Cedula']) || empty($_POST['Primer_Nombre']) || empty($_POST['Segundo_Nombre']) || empty($_POST['Primer_Apellido']) || empty($_POST['Segundo_Apellido']) || empty($_POST['Correo'])
	){
       
		//$Register_alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
  

		}else{
	
						$cedula = $_POST['Cedula'];
						$primernombre = $_POST['Primer_Nombre'];
                        $segundonombre = $_POST['Segundo_Nombre'];
                        $primerapellido = $_POST['Primer_Apellido'];
                        $segundoapellido = $_POST['Segundo_Apellido'];
						$direccion = $_POST['Direccion'];
						$celular = $_POST['Numero_de_celular'];
						$correo = $_POST['Correo'];
						$contrasena= $_POST['Contrasena'];
						$idusuario= $_POST['Tipo_de_Usuario'];
                        $cargo= $_POST['Cargo'];
						$query_insert = mysqli_query($conexion, "INSERT INTO usuario(cedula, primer_nombre,	segundo_nombre, primer_apellido, segundo_apellido, direccion, numero_celular, correo, contrasena, cod_usuario, cod_cargo) 
						VALUES('$cedula','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$direccion','$celular','$correo','$contrasena','$idusuario','$cargo')");
						if($query_insert){
							$Register_alert='<p class = "msg_save">Usuario registrado correctamente.</p>';
						}else{
							$Register_alert='<p class = "msg_error">Error al registrar el usuario.</p>';
						}
					}
             
        }
	
?>

<?php include_once 'Modulos/Templates/Header_Admin.php'; ?>


<body>
<div class = "Register_alert"><?php echo isset($Register_alert) ? $Register_alert : ''; ?></div>
   
<form class="formulario_usuario" action="" method="post" >
        <h1> Registra a tu usuario </h1>
        <div class="contenedor_usu">
            <div class="input-contenedor_usu">
                <input type="text" name="Cedula" id="Cedula" class="entrada" placeholder="Cedula" >
            </div>
            <div class="input-contenedor_usu">
                <input type="text" name="Primer_Nombre" id= "Primer_Nombre" class="entrada" placeholder="Primer Nombre" >
            </div>
            <div class="input-contenedor_usu">
                <input type="text" name="Segundo_Nombre" id="Segundo_Nombre" class="entrada" placeholder="Segundo Nombre" >
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
                <input type="text" name="Primer_Apellido" id="Primer_Apellido" class="entrada" placeholder="Primer Apellido" >
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
                <input type="text" name="Segundo_Apellido" id="Segundo_Apellido" class="entrada" placeholder="Segundo Apellido" >
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
                <input type="text" name="Direccion" id="Direccion" class="entrada" placeholder="Direccion">
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
                <input type="text" name="Numero_de_celular" id="Numero_de_celular" class="entrada" placeholder="Numero de celular">
            </div>
            <div class="input-contenedor_usu">
                <!--Poner el incono despues -->
                <input type="text" name="Correo" id="Correo" class="entrada" placeholder="Correo" >
            </div>
            <div class="input-contenedor_usu">
            <label for = "Cargo">Cargo</label>
            
				<?php
					$query_Cargo = mysqli_query($conexion, "SELECT * FROM cargo ORDER BY nombre_cargo ASC");
					$result_Cargo = mysqli_num_rows($query_Cargo);	
				?>
				<select name="Cargo" id="Cargo">
				<?php   	
					if($result_Cargo > 0){
						while ($Cargo = mysqli_fetch_array($query_Cargo)){
				?>
				<option value="<?php echo $Cargo["cod_cargo"]; ?>"><?php echo $Cargo["nombre_cargo"] ?></option>
				<?php
						}
					}
				?>
                
				</select>
            </div>
            <div class="input-contenedor_usu">
            <label for = "Tipo_usuario">Tipo de usuario</label>
            
            <?php
                $query_Tipo = mysqli_query($conexion, "SELECT * FROM tipo_usuario ORDER BY nombre_tipo_usuario ASC");
                $result_Tipo = mysqli_num_rows($query_Tipo);	
            ?>
            <select name="Tipo_de_Usuario" id="Tipo_de_Usuario">
            <?php   	
                if($result_Tipo> 0){
                    while ($Tipo = mysqli_fetch_array($query_Tipo)){
            ?>
            <option value="<?php echo $Tipo["cod_usuario"]; ?>"><?php echo $Tipo["nombre_tipo_usuario"] ?></option>
            <?php
                    }
                }
            ?>
            
            </select>
            </div>

            <div class="input-contenedor_usu">
               
                <input type="password" name="Contrasena" id="Contrasena" class="entrada" placeholder="Contrasena" >
            </div>
            
            <button type="submit" class="botonreg"> Registrar </button>
          
            </div>
            
    </form>
    
</body>


<?php include_once 'Modulos/Templates/Footer_Admin.php'; ?>