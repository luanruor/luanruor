<?php
	include("conexion.php");
	$departamento=intval($_REQUEST['departamento']);
	$municipios = $conn->prepare("SELECT * FROM municipios WHERE IdDepartamento = '$departamento' AND Estado='Activo'") or die(mysqli_error());
	if($municipios->execute()){
		$a_result = $municipios->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['Id'].'">'.utf8_encode( $row['Nombre']).'</option>';
		}
?>