<?php
include("conexion.php");//Contiene de conexion a la base de datos
session_start();
if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo']=time();
}else if (time() - $_SESSION['tiempo'] > 600) {
    session_destroy();
    header("Location: index.php");
    die();  
}
$_SESSION['tiempo']=time();
$error=''; // Variable para almacenar el mensaje de error
// Guardando la sesion
if (isset($_SESSION['login_user_sys'])) {
	$user_check=$_SESSION['login_user_sys'];
	// SQL Query para completar la informacion del usuario
	$ses_sql=mysqli_query($conn, "select Nombres, Apellidos, Usuario from usuarios where Usuario='$user_check'");
	$row = mysqli_fetch_assoc($ses_sql);
	$login_session =$row['Usuario'];
	$nombres=$row['Nombres'];
	$apellidos=$row['Apellidos'];	
}else{
	session_destroy();
	header("Location: index.php");
}
$sql = $conn->prepare("SELECT Estado FROM promo WHERE Id=1");
    if($sql->execute()){                                
        $g_result = $sql->get_result();
    }
    while($row = $g_result->fetch_array()){
        $estadoc=$row['Estado']; 
    }

?>