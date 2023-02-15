<?php 
include("../../bd.php");
if ($_POST) {
    $usuario = (isset($_POST["usuario"])?$_POST["usuario"]:"");
    $contrasena = (isset($_POST["contrasena"])?$_POST["contrasena"]:"");
    $email = (isset($_POST["email"])?$_POST["email"]:"");
    $sentencia = $conexion->prepare("INSERT INTO usuarios(id,usuario,contrasena,email) VALUES (NULL, :usuario, :contrasena, :email)");
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":contrasena",$contrasena);
    $sentencia->bindParam(":email",$email);
    $sentencia->execute();
    $mensaje = "Registro añadido";
    header ("Location:index.php?mensaje=".$mensaje);
}
include("../../templates/header.php"); 
?>
<div class="container">
<div class="row">
<div class="col-md-4">
        
</div>
<div class="col-md-4">
    <br/><br/>
<div class="card">
    <div class="card-header">
    <h3 class="text-info">Datos del usuario</h3>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del usuario</label>
              <input type="text" required 
                     class="form-control" name="usuario" id="usuario" 
                     aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
              <label for="contrasena" class="form-label">Contraseña</label>
              <input type="password" required
                     class="form-control" name="contrasena" id="contrasena" 
                     aria-describedby="helpId" placeholder="Escribe la contraseña">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" required
                     class="form-control" name="email" id="email" 
                     aria-describedby="helpId" placeholder="Escribe el email">
            </div>
            <button type="submit" class="btn btn-success">Añadir</button> |
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>
</div>
</div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer.php"); ?>