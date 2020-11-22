<?php 
include 'head.php';
include 'menu.php';
include 'controladores/login.php';

if(isset($_SESSION["login_user_sys"])){
header("location: interno.php");
} 
?>
    <span>
    <?php 
        if($error!=""){
            echo "<script>alert('".$error."')</script>";
        }
    ?>
    </span>

    <div class="panel panel-info" name="Formulario" id="Formulario" style="display: none;">
        <div class="panel-heading">
            <h3 class="panel-title">
                <strong>
                    Registro Clientes
                </strong>
            </h3>
        </div>
        <div class="panel-body panel-info">
            <label class="font-weight-bold">
                DATOS B&Aacute;SICOS
            </label>
            <form action="controladores/guardar.php" method="POST" onsubmit="return checkSubmit();">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Primer Nombre <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="PrimerNombre" required autofocus maxlength="25">
                </div>
                <div class="form-group col-md-6">
                    <label>Segundo Nombre</label>
                    <input type="text" class="form-control" name="SegundoNombre" maxlength="25">
                </div>

                <div class="form-group col-md-6">
                    <label>Primer Apellido <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="PrimerApellido" required maxlength="25">
                </div>
                <div class="form-group col-md-6">
                    <label>Segundo Apellido</label>
                    <input type="text" class="form-control" name="SegundoApellido" maxlength="25">
                </div>

                <div class="form-group col-md-6">
                    <label>Tipo identificaci&oacute;n <b class="text-danger">*</b></label>
                    <label>Tipo identificaci&oacute;n <b class="text-danger">*</b></label>
                    <select class="form-control" name="TipoDocumento" required>
                        <?php
                            $sql = $conn->prepare("SELECT * FROM tipodocumento WHERE Estado='Activo'");
                            if($sql->execute()){                                
                                $g_result = $sql->get_result();
                            }
                            while($row = $g_result->fetch_array()){
                        ?><option class="form-control" value = <?php echo $row['Id']; 
                                    ?>> <?php echo utf8_encode($row['Nombre'])?></option>
                            <?php
                                    }   
                                    ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>N&uacute;mero de identificaci&oacute;n <b class="text-danger">*</b></label>
                    <input type="number" class="form-control" name="NumeroDocumento" required min="1000" max="99999999999" maxlength="11">
                    <label name="Consulta" id="Consulta"></label>
                </div>

                <div class="form-group col-md-6">
                    <label>Departamento <b class="text-danger">*</b></label>
                    <select class="form-control" name="Departamento" id="Departamento" required>
                        <option value="">Seleccione un Departamento</option>
                        <?php
                            $sql = $conn->prepare("SELECT * FROM departamentos WHERE Estado='Activo'");
                            if($sql->execute()){                                
                                $g_result = $sql->get_result();
                            }
                            while($row = $g_result->fetch_array()){
                        ?><option class="form-control" value = <?php echo $row['Id']; 
                                    ?>> <?php echo utf8_encode($row['Nombre'])?></option>
                            <?php
                                    }   
                                    ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Municipio <b class="text-danger">*</b></label>
                    <select name="Municipio" id="Municipio" class="form-control" required disabled>
                        <option value="">Selecciona un municipio</option>";
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Celular <b class="text-danger">*</b></label>
                    <input type="number" class="form-control" name="Celular" required min="3000000000" max="3519999999" maxlength="10">
                </div>
                <div class="form-group col-md-6">
                    <label>Celular Alterno</label>
                    <input type="number" class="form-control" name="CelularAlterno" min="3000000000" max="3519999999" maxlength="10">
                </div>
                <div class="form-group col-md-6">
                    <label>Correo Electrónico <b class="text-danger">*</b></label>
                    <input type="email" class="form-control" name="Correo" required maxlength="100">
                </div>
                <div class="form-group col-md-6">
                    <label>Correo Alterno</label>
                    <input type="email" class="form-control" name="CorreoAlterno" maxlength="100">
                </div>
                <div class="form-group col-md-12">
                    <div class="input-group">
                        <input type="checkbox" class="form-check-input" name="HabeasData" id="HabeasData">
                        <label class="" for="HabeasData">Autorizo el tratamiento de mis datos de acuerdo con la finalidad establecida en la política de protección de datos personales. <b class="text-danger">*</b></label>
                        <button type="button" class="a-info" data-toggle="modal" data-target="#HabeasDataTerminos">
                        Haga clic aquí
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <input type="submit" value="Enviar" id="Enviar" name="Enviar" class="btn btn-info" disabled="">
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="container h-100" name="FCerrado" id="FCerrado" style="display: none;">
        <div class="row justify-content-center h-100">
            <div class="col-sm-12 align-self-center text-center">
                <div class="card shadow">
                    <div class="card-body">
                        El Ganador(a) de este evento es: 
                        <br>
                        <h2 class="text-danger">
                        <?php  
                        $sql = $conn->prepare("SELECT * FROM clientespotenciales WHERE observacion='ESTE ES EL GANADOR'");
                        if($sql->execute()){                                
                            $g_result = $sql->get_result();
                        }
                        while($row = $g_result->fetch_array()){
                            $primernombre=$row['PrimerNombre'];
                            $segundonombre=$row['SegundoNombre'];
                            $primerapellido=$row['PrimerApellido'];
                            $segundoapellido=$row['SegundoApellido'];
                        }
                        echo utf8_encode($primernombre." ".$segundonombre." ".$primerapellido." ".$segundoapellido);
                        ?>
                        </h2>
                        <br>
                        <img src="imagenes/gracias-por-registrarte.png">
                        <br>
                        Se Realizó la culminación de esta promoción.
                  </div>
              </div>
          </div>
      </div>
    </div>

<div class="modal fade" id="miModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ingreso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="usuario" placeholder="Usuario" autofocus required tabindex="1">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Clave" name="clave" required tabindex="2">
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="submit" class="btn btn-info pull-right" value="Entrar" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="HabeasDataTerminos">
    <div class="modal-dialog modal-M">
        <div class="modal-content">
            <div class="modal-header">
                <strong>
                <h5 class="modal-title" id="myModalLabel">
                Política de tratamiento de datos personales
                </h5>
                </strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    Ley de Protección de Datos Personales: “La autorización suministrada en el presente formulario faculta a INXAITCORP para que dé a sus datos aquí recopilados el tratamiento señalado en la “Política de Privacidad para el Tratamiento de Datos Personales” de INXAITCORP, el cual incluye, entre otras, el envío de información promocional, así como la invitación a eventos. El titular de los datos podrá, en cualquier momento, solicitar que la información sea modificada, actualizada o retirada de las bases de datos de INXAITCORP.
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
    $sql = $conn->prepare("SELECT Estado FROM promo WHERE Id=1");
    if($sql->execute()){                                
        $g_result = $sql->get_result();
    }
    while($row = $g_result->fetch_array()){
        $estadoc=$row['Estado']; 
    }
    if ($estadoc=="Activo") {
        echo "<script type='text/javascript'>document.getElementById('Formulario').style.display = 'inline';</script>";
    }else{
        echo "<script type='text/javascript'>document.getElementById('FCerrado').style.display = 'inline';</script>";
    }
    ?>
<?php 
include 'footer.php';
?>