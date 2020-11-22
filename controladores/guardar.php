<?php
include '../head.php'; 

$PrimerNombre=utf8_decode($_POST["PrimerNombre"]);
$SegundoNombre=utf8_decode($_POST["SegundoNombre"]);
$PrimerApellido=utf8_decode($_POST["PrimerApellido"]);
$SegundoApellido=utf8_decode($_POST["SegundoApellido"]);
$TipoDocumento=$_POST["TipoDocumento"];
$NumeroDocumento=$_POST["NumeroDocumento"];
$Municipio=$_POST["Municipio"];
$Celular=$_POST["Celular"];
$CelularAlterno=$_POST["CelularAlterno"];
$Correo=$_POST["Correo"];
$CorreoAlterno=$_POST["CorreoAlterno"];
$HabeasData=$_POST["HabeasData"];

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
$sql = "
INSERT INTO clientespotenciales(
FechaHoraRegistro, 
PrimerNombre, 
SegundoNombre, 
PrimerApellido, 
SegundoApellido, 
TipoDocumento, 
NumeroDocumento, 
Municipio, 
Celular, 
CelularAlterno, 
Correo, 
CorreoAlterno,
IdPromo
) 
VALUES(
NOW(), 
'$PrimerNombre',
'$SegundoNombre', 
'$PrimerApellido', 
'$SegundoApellido', 
'$TipoDocumento', 
'$NumeroDocumento', 
'$Municipio', 
'$Celular', 
'$CelularAlterno', 
'$Correo', 
'$CorreoAlterno',
'1'
)
";

echo $sql;

if (mysqli_query($conn, $sql)) {
	echo "Registro ingresado correctamente";
	echo "
		<script>
			window.location='../RegistroExitoso.php';
		</script>
	";
	echo "  
    Los datos fueron registrados con EXITO!!! 
    <br>
    <p><a href='../index.php' class='btn btn-info'>Regresar a la pagina anterior</a></p> 
    ";
} else {
	$error = "Error: " . $sql . "" . mysqli_error($conn);
	include '../error.php';
	echo "<script>
	function redireccionarPagina() {
  		window.location = '../index.php';
	}
	setTimeout('redireccionarPagina()', 5000);
	</script>";
	
}
$conn->close();

      

    
?>  