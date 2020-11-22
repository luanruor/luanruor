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
    
<div class="container h-100">
    <div class="row justify-content-center h-100">
        <div class="col-sm-12 align-self-center text-center">
            <div class="card shadow">
                <div class="card-body">           
                  <img src="imagenes/gracias-por-registrarte.png">
                  <br>
                  Quieres Hacer otro registro? <a href="index.php" class="btn-info">Haz Clic Aquí</a>
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
                <form  method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="usuario" placeholder="Usuario" autofocus required tabindex="1">
                    </div>
                    <div class="input-group">
                        <a href="formularios/recordarusuario.php">
                            Recordar Usuario
                        </a>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Clave" name="clave" required tabindex="2">
                    </div>
                    <div class="input-group">
                        <a href="formularios/recuperarclave.php">
                            Recuperar Clave
                        </a>
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

<?php 
include 'footer.php';
?>