<?php  
header("Pragma: public");
header("Expires: 0");
$filename = "Clientes.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
?>

<table>
			<thead>
				<tr>
					<th scope="col">Item</th>
					<th scope="col">Fecha Registro</th>
					<th scope="col">Primer Nombre</th>
					<th scope="col">Segundo Nombre</th>
					<th scope="col">Primer Apellido</th>
					<th scope="col">Segundo Apellido</th>
					<th scope="col">Tipo Documento</th>
					<th scope="col">Numero Documento</th>
					<th scope="col">Departamento</th>
					<th scope="col">Municipio</th>
					<th scope="col">Celular</th>
					<th scope="col">Celular Alterno</th>
					<th scope="col">Correo</th>
					<th scope="col">Correo Alterno</th>
					<th scope="col">Observaciones</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					include "controladores/conexion.php";
					$clientes = $conn->prepare("CALL ListarClientes") or die(mysqli_error());
					if($clientes->execute()){
						$a_result = $clientes->get_result();
					}
					$x=0;
					while($row = $a_result->fetch_array()){
						$x++;
						echo '<tr>
					<th scope="row">'.$x.'</th>
					<td>'.$row['FechaHoraRegistro'].'</td>
					<td>'.$row['PrimerNombre'].'</td>
					<td>'.$row['SegundoNombre'].'</td>
					<td>'.$row['PrimerApellido'].'</td>
					<td>'.$row['SegundoApellido'].'</td>
					<td>'.$row['NombreTipoDocumento'].'</td>
					<td>'.$row['NumeroDocumento'].'</td>
					<td>'.$row['NombreDepartamento'].'</td>
					<td>'.$row['NombreMunicipio'].'</td>
					<td>'.$row['Celular'].'</td>
					<td>'.$row['CelularAlterno'].'</td>
					<td>'.$row['Correo'].'</td>
					<td>'.$row['CorreoAlterno'].'</td>
					<td>'.$row['Observacion'].'</td>
				</tr>';
					}
				?>
				
			</tbody>
		</table>