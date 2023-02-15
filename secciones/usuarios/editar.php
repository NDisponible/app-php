<?php
include("../../bd.php");
if(isset($_GET['id'])) {
    $id = (isset($_GET['id']))?$_GET['id']:"";
    $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $usuario = $registro["usuario"];
    $contrasena = $registro["contrasena"];
    $email = $registro["email"];
}
if ($_POST) {
    $id = (isset($_POST['id']))?$_POST['id']:"";
    $usuario = (isset($_POST["usuario"])?$_POST["usuario"]:"");
    $contrasena = (isset($_POST["contrasena"])?$_POST["contrasena"]:"");
    $email = (isset($_POST["email"])?$_POST["email"]:"");
    $sentencia = $conexion->prepare("UPDATE usuarios SET usuario=:usuario, contrasena=:contrasena, email=:email WHERE id=:id");
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":contrasena",$contrasena);
    $sentencia->bindParam(":email",$email);
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $mensaje = "Registro actualizado";
    header ("Location:index.php?mensaje=".$mensaje);
}
?>
<?php include("../../templates/header.php"); ?>
<div class="container">
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
    <br/><br/>
<div class="card">
    <div class="card-header">
    <h3 class="text-info">Datos del usuario</h3>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="id" class="form-label">ID:</label>
              <input type="text" readonly value="<?php echo $id; ?>"
                     class="form-control" name="id" id="id" 
                     aria-describedby="helpId" placeholder="id">
            </div>
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del usuario</label>
              <input type="text" value="<?php echo $usuario; ?>"
                     class="form-control" name="usuario" id="usuario" 
                     aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
              <label for="contrasena" class="form-label">Contraseña:</label>
              <input type="password" value="<?php echo $contrasena; ?>"
                     class="form-control" name="contrasena" id="contrasena" 
                     aria-describedby="helpId" placeholder="Escribe la contraseña">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" value="<?php echo $email; ?>"
                     class="form-control" name="email" id="email" 
                     aria-describedby="helpId" placeholder="Escribe el email">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button> |
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>
</div>
</div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer.php"); ?>