<?php $alert = '';

$datos_usuario = file_get_contents("usuario.json");
$json_usuario = json_decode($datos_usuario, true);

session_start();
include "Configuraciones/Funciones.php";

if (!empty($_SESSION['active'])) {
  if ($json_usuario['cod_usuario'] != 0) {
    header('location: Solicitud_Empleado.php');
  }
  if ($json_usuario['cod_usuario'] == 0) {
    header('location: Admin.php');
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

          //JSON de usuario
          $person_prueba = array(
            'active' => true,
            'cedula' =>  $data['cedula'],
            'primer_nombre' => $data['primer_nombre'],
            'segundo_nombre' => $data['segundo_nombre'],
            'primer_apellido' => $data['primer_apellido'],
            'segundo_apellido' => $data['segundo_apellido'],
            'imagen' => $data['imagen'],
            'direccion' => $data['direccion'],
            'numero_celular' => $data['numero_celular'],
            'correo' => $data['correo'],
            'cod_usuario' => $data['cod_usuario'],
            'cod_cargo' => $data['cod_cargo'] 
          );
          $json_string = json_encode($person_prueba);
          $file = 'usuario.json';
          file_put_contents($file, $json_string);

          
          $datos_usuario = file_get_contents("usuario.json");
          $json_usuario = json_decode($datos_usuario, true);

          if ($json_usuario['cod_usuario'] == 0) {
            header('location: Admin.php');
          } else if ($json_usuario['cod_usuario'] != 0) {

            header('location: Solicitud_Empleado.php');
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

    <div class="alert">
    </div>
      <form action="#" class="sign-in-form form_login_v" method="POST">
        <!--ESTE ES EL FORMULARIO DE INICIAR SESION-->
        <p>
        <?php
          // $resultado = json_decode(strval($resultados), true);

          // $datos_clientes = file_get_contents("usuario.json");
          // $json_clientes = json_decode($datos_clientes, true);
          // echo $json_clientes['primer_nombre'];
          // foreach ($json_clientes as $cliente) {
          // echo $cliente."<br>";
          // }

          //var_dump($person);
          ?>
        </p>
        <p>
        <?php 
        // $resultados = '{"nombre": "lucia", "apellido": "SArmiento"}';
        // $resultado = json_decode(strval($resultados), true);
        // var_dump($resultado);
        // echo $resultado; ?>
        </p>
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
    </div>
  </div>
  <div class="panels-container">
    <div class="panel left-panel">
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