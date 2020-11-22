<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
</script>

<script type = "text/javascript">
	document.oncontextmenu = function(){return false}//deshabilitando el click derecho

	function cerrar(){
		var r = confirm("¿Desea cerrar esta Campaña?");
		if (r == true) {
			return true;
		}else{
			return false;
		}
	}

	function checkSubmit() {
		document.getElementById("btsubmit").value = "Enviando...";
		document.getElementById("btsubmit").disabled = true;
		return true;
	}

	$(document).ready(function(){
	//Cambios de lista dependiente de municipios
	$('#Departamento').on('change', function(){
		if($('#Departamento').val()==""){
			$('#Municipio').empty();
			$('<option value="">Selecciona un municipio</option>').appendTo('#Municipio');
			$('#Municipio').attr('disabled', 'disabled');
		}else{
			$('#Municipio').removeAttr('disabled', 'disabled');
			$('#Municipio').load('controladores/municipio_get.php?departamento='+$('#Departamento').val());
		}
	});

	//validar que el boton de autorizar el tratamiento de datos esté checkeado
	document.getElementById("HabeasData").addEventListener('change', verificacheck);

	function verificacheck(event) {
		var Enviar = document.getElementById("Enviar");
		console.log(this.checked);
		Enviar.disabled = !this.checked;
	}

	})


</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
