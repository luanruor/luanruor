<?php include '../head.php'; 
include '../menu.php';
// Recibimos por POST los datos procedentes del formulario  

$accion=$_POST["accion"];

$consulta="UPDATE promo SET Estado='Inactivo' WHERE Id=1";
$sql = $conn->prepare($consulta);
$sql->execute();
$sql = $conn->prepare("SELECT FLOOR(1 + (RAND() * (SELECT COUNT(Id) FROM clientespotenciales))) AS Id");
    if($sql->execute()){                                
        $g_result = $sql->get_result();
    }
    while($row = $g_result->fetch_array()){
        $ganador=$row['Id']; 
    }
$consulta="UPDATE clientespotenciales SET Observacion='ESTE ES EL GANADOR' WHERE Id=$ganador";
		

$sql = $conn->prepare($consulta);

$sql->execute();

    echo "  
    <script>
		window.location='../index.php';
	</script>
    ";
 
?> 
<?php include '../vistas/footer.php'; ?>