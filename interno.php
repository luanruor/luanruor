<?php 
include 'head.php';
include 'controladores/session.php';
include 'menu2.php';
?>
    
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">
			<strong>
				Registro Clientes
			</strong>
		</h3>
	</div>
	<div class="row">
		<div>
			<a href="excel.php" class="btn btn-info">Exportar a Excel</a>
		</div class="col">
		<div id="seleccionar" name="seleccionar" style="display: none">
			<form action="controladores/seleccionarganador.php" method="post" onsubmit="return cerrar()">
				<button type="submit" class="btn btn-success btn-xs" title="Seleccionar Ganador">
					Seleccionar Ganador
                </button>
                <input type="hidden" name="accion" value="seleccionar">
            </form>
		</div>
	</div>	
	<div class="table-responsive">
		<table class="table-bordered table-responsive table-striped table-hover">
			<thead>
				<tr>
					<th scope="col">Item</th>
					<th scope="col">Fecha_Registro</th>
					<th scope="col">Primer_Nombre</th>
					<th scope="col">Segundo_Nombre</th>
					<th scope="col">Primer_Apellido</th>
					<th scope="col">Segundo_Apellido</th>
					<th scope="col">Tipo_Documento</th>
					<th scope="col">Numero_Documento</th>
					<th scope="col">Departamento</th>
					<th scope="col">Municipio</th>
					<th scope="col">Celular</th>
					<th scope="col">Celular_Alterno</th>
					<th scope="col">Correo</th>
					<th scope="col">Correo_Alterno</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				$clientes = $conn->prepare("CALL ListarClientes") or die(mysqli_error());
				if($clientes->execute()){
					$a_result = $clientes->get_result();
				}
				$x=0;
				while($row = $a_result->fetch_array()){
					$x++;
					echo '<tr>
					<th scope="row">'.$x.'</th>
					<td>'.date("d-m-Y H:i:s", strtotime($row['FechaHoraRegistro'])).'</td>
					<td>'.utf8_encode($row['PrimerNombre']).'</td>
					<td>'.utf8_encode($row['SegundoNombre']).'</td>
					<td>'.utf8_encode($row['PrimerApellido']).'</td>
					<td>'.utf8_encode($row['SegundoApellido']).'</td>
					<td>'.utf8_encode($row['NombreTipoDocumento']).'</td>
					<td>'.$row['NumeroDocumento'].'</td>
					<td>'.utf8_encode($row['NombreDepartamento']).'</td>
					<td>'.utf8_encode($row['NombreMunicipio']).'</td>
					<td>'.$row['Celular'].'</td>
					<td>'.$row['CelularAlterno'].'</td>
					<td>'.$row['Correo'].'</td>
					<td>'.$row['CorreoAlterno'].'</td>
					</tr>';
				}
				?>
				
			</tbody>
		</table>
		<?php echo "Total Registros: ".$x; 
			if ($x>=5 AND $estadoc=="Activo") {
				echo "<script type='text/javascript'>
				document.getElementById('seleccionar').style.display = 'inline';
				</script>";
			}
			?>
	</div>
</div>
<?php 
include 'footer.php';
?>