<?php $alert = '';
session_start();
include "Configuraciones/Funciones.php";
if (!empty($_SESSION['active'])) {
  if ($_SESSION['cod_usuario'] != 0) {
    header('location: index.php');
  }
}
if (isset($_POST['btnacceso'])) {
  $valor = $_POST['btnacceso'];
  if ($valor == "Ingresar") {
    if (!empty($_SESSION['active'])) {
      if ($_SESSION['cod_usuario'] == 0) {
        header('location: Admin.php');
      } else if ($_SESSION['cod_usuario'] != 0) {
        header('location: index.php');
      }
    } else {
      if (empty($_POST['usuario']) || empty($_POST['clave'])) {
        $alert = 'Ingrese su usuario y contraseña';
      } else {
        require_once "Configuraciones/Funciones.php";
        $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
        $pass = mysqli_real_escape_string($conexion, $_POST['clave']);
        $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE cedula = '$user' AND contrasena = '$pass'");
        $result = mysqli_num_rows($query);
        if ($result > 0) {
          $data = mysqli_fetch_array($query);
          $_SESSION['active'] = true;
          $_SESSION['cedula'] = $data['cedula'];
          $_SESSION['primer_nombre'] = $data['primer_nombre'];
          $_SESSION['segundo_nombre'] = $data['segundo_nombre'];
          $_SESSION['primer_apellido'] = $data['primer_apellido'];
          $_SESSION['segundo_apellido'] = $data['segundo_apellido'];
          $_SESSION['imagen'] = $data['imagen'];
          $_SESSION['direccion'] = $data['direccion'];
          $_SESSION['numero_celular'] = $data['numero_celular'];
          $_SESSION['correo'] = $data['correo'];
          $_SESSION['contrasena'] = $data['contrasena'];
          $_SESSION['cod_usuario'] = $data['cod_usuario'];
          $_SESSION['cod_cargo'] = $data['cod_cargo'];

          if ($_SESSION['cod_usuario'] == 0) {
            header('location: Admin.php');
          } else if ($_SESSION['cod_usuario'] != 0) {
            header('location: index.php');
          }
        } else {
          $alert = 'El usuario o la contraseña son incorrectos';
          session_destroy();
        }
      } //ELSE DESPUES DE INGRESE SU USUARIO
    } //ELSE
  } //IF INGRESAR
} //IF BOTON ACCESO

?>

<?php include_once 'Modulos/Templates/header.php'; ?>

<div class="container">
  <div class="forms-container">
    <div class="signin-signup">

      <form action="#" class="sign-in-form form_login_v" method="POST">
        <!--ESTE ES EL FORMULARIO DE INICIAR SESION-->
        <h2 class="title">Iniciar sesion</h2> <!-- Título de la sección de login que dice "Iniciar sesion" -->
        <div class="input-field">
          <!-- Parte o espacio que contiene el input del nombre de usuario -->
          <i class="fas fa-user"></i>
          <input type="text" placeholder="Usuario" name="usuario" /> <!-- Elemento que recibe el nombre de usuario -->
        </div>
        <div class="input-field">
          <!-- Parte o espacio que contiene el input de contraeña de usuario -->
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Clave" name="clave" /> <!-- Elemento que recibe la clave de usuario -->
        </div>
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <input type="submit" value="Ingresar" name="btnacceso" class="btn solid" />
      </form>
      <!-- <form class="sign-up-form form_login_v" method="POST"> -->
      <!--ESTE ES EL FORMULARIO DE REGISTRATE-->
      <!-- <div class = "Register_alert" ><?php // echo isset($Register_alert) ? $Register_alert : ''; 
                                          ?></div>
            <h2 class="title">Registrate</h2>
              <div class="general_registrate">
                <div class="input-field-dos">
                <i class="far fa-id-card"></i>
                  <input type="text" name="cedula" id="cedula" placeholder="Cedula"/>
                </div>
                <div class="input-field-dos">
                  <i class="fas fa-user"></i>
                  <input type="text" name="primernombre" id="primernombre" placeholder="Primer Nombre"/>
                </div>
                <div class="input-field-dos">
                  <i class="fas fa-user"></i>
                  <input type="text" name="segundonombre" id="segundonombre" placeholder="Segundo Nombre"/>
                </div>
                <div class="input-field-dos">
                  <i class="fas fa-user"></i>
                  <input type="text" name="primerapellido" id="primerapellido" placeholder="Primer Apellido"/>
                </div>
                <div class="input-field-dos">
                  <i class="fas fa-user"></i>
                  <input type="text" name="segundoapellido" id="segundoapellido" placeholder="Segundo Apellido"/>
                </div>
                <div class="input-field-dos">
                  <i class="fas fa-envelope"></i>
                  <input type="email" name="correo" id="correo" placeholder="Correo electronico"/>
                </div>
                <div class="input-field-dos">
                <i class="fas fa-mobile-alt"></i>
                  <input type="text" name="telefono" id="telefono" placeholder="Telefono"/>
                </div>
                <div class="input-field-dos">
                <i class="fas fa-home"></i>
                  <input type="text" name="direccion" id="direccion" placeholder="Direccion"/>
                </div>
                <div class="input-field-dos">
                <i class="fas fa-user-circle"></i>
                  <input type="text" name="usuario" id="usuario" placeholder="Usuario"/>
                </div>
                <div class="input-field-dos">
                  <i class="fas fa-lock"></i>
                  <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña"/>
                </div>
                <?php
                // $query_rol = mysqli_query($conexion, "SELECT * FROM rol");
                // $result_rol = mysqli_num_rows($query_rol);
                ?>
              </div>
                <div class="content-selectregis">
                  <select name="rol" id="rol">
                  <option value="Tipo usuario"> Tipo usuario</option>
                    <?php
                    // if($result_rol > 0){
                    //   while ($rol = mysqli_fetch_array($query_rol)){
                    //     if($_SESSION['ID_Rol'] == 1){
                    ?>
                      <option value="<?php echo $rol["ID_Rol"]; ?>"><?php echo $rol["Nombre"] ?></option>
                    <?php
                    //   }else if($_SESSION['ID_Rol'] != 1 || empty($_SESSION['ID_Rol'])){
                    //     if($rol["ID_Rol"] != 1){
                    ?>
                      <option value="<?php echo $rol["ID_Rol"]; ?>"><?php echo $rol["Nombre"]; ?></option>
                    <?php
                    //       }
                    //     }
                    //   }
                    // }
                    ?>
                  </select>
                  <i></i>
                </div>
      
                <div class="content-selectregis">
                  <select name="cargo" id="cargo">
                  <option value="Tipo cargo"> Cargo</option>
                    
                      <option value="<?php //echo $cargo["ID_Rol"]; 
                                      ?>"><?php echo $cargo["Nombre"]; ?></option>
      
                  </select>
                  <i></i>
                </div>
               
                <div class="Contenido_Checkbox_Registrar">
                  <div class="checkbox_r">
                    <input type="checkbox" class="tamaño_check" name="checkbox" id="checkbox" onclick= "enableSending();">
                  </div>
                  <label for="checkbox" class="Label_Checkbox">He leído y acepto los 
                    <a href="Archivos de Pets' Home//POLITICA DE PRIVACIDAD DE PETS´ HOME.pdf" target = "_blank">Terminos y condiciones<a>
                  </label>
                </div>
                <input type="submit" class="btn" value="Registrate" name="btnacceso" />  -->
      </form>
    </div>
  </div>
  <div class="panels-container">
    <div class="panel left-panel">
      <!-- <div class="content">
            <h3 class="titulo_login">¿Eres nuevo aqui?</h3>
            <p>
              Si no tienes una cuenta registrada, registrate aquí.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Registrate
            </button>
          </div> -->
      <img src="img/logo6.png" class="image" alt="" />
    </div>
    <div class="panel right-panel">
      <div class="content">
        <h3 class="titulo_login">¿Ya tienes cuenta?</h3>
        <p>
          Si ya tienes cuenta, puedes iniciar directamente.
        </p>
        <button class="btn transparent" id="sign-in-btn">
          Iniciar sesion
        </button>
      </div>
      <img src="img/logo7.png" class="image" alt="" />
    </div>
  </div>
</div>
<script src="app.js"></script><!-- ESTE ARCHIVO CREA LA INIMACIÓN PARA PASAR DE INICIAR SESIÓN A REGISTRATE-->