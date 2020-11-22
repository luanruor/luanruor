<?php
session_start(); // Iniciando sesion
$error=''; // Variable para almacenar el mensaje de error
if (isset($_POST['submit'])) {

	// Define $usuario y $clave
	$username=$_POST['usuario'];
	$password=$_POST['clave'];

	// Estableciendo la conexion a la base de datos
	include("conexion.php");//Contiene de conexion a la base de datos

	// Para proteger de Inyecciones SQL 
	$username    = mysqli_real_escape_string($conn,(strip_tags($username,ENT_QUOTES)));
	$password =  mysqli_real_escape_string($conn,(strip_tags($password,ENT_QUOTES)));

	$sql = "SELECT Usuario, Clave, Nombres, Apellidos FROM usuarios WHERE Usuario = '" . $username . "';";
	$query=mysqli_query($conn,$sql);
	$counter=mysqli_num_rows($query);
	$error = "Usuario NO Existe.";
	if ($counter==1){
		$sql = "SELECT Usuario, Nombres, Apellidos FROM usuarios WHERE Estado='Activo' AND Usuario = '" . $username . "';";
		$query=mysqli_query($conn,$sql);
		$counter=mysqli_num_rows($query);
		if ($counter==1) {
			$sql = "SELECT Usuario, Clave, Nombres, Apellidos FROM usuarios WHERE Usuario = '" . $username . "' and Clave='".$password."';";
			$query=mysqli_query($conn,$sql);
			$counter=mysqli_num_rows($query);
			if ($counter==1) {
				$_SESSION['login_user_sys']=$username; // Iniciando la sesion
				header("location: ./Vistas/"); // Redireccionando a la pagina index.php
			}else{
				$error = "Clave Incorrecta.";
			}
		}else{
			$error = "Usuario Deshabilitado, contactar con el Administrador.";
		}
	}
}
?>