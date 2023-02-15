<?php
include("../../bd.php");
if(isset($_GET['id'])) {
    $id = (isset($_GET['id']))?$_GET['id']:"";
    $sentencia = $conexion->prepare("SELECT * FROM puestos WHERE id=:id");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombrePuesto = $registro["nombrePuesto"];
}
if ($_POST) {
    $id = (isset($_POST['id']))?$_POST['id']:"";
    $nombrePuesto = (isset($_POST["nombrePuesto"])?$_POST["nombrePuesto"]:"");
    $sentencia = $conexion->prepare("UPDATE puestos SET nombrePuesto=:nombrePuesto WHERE id=:id");
    $sentencia->bindParam(":nombrePuesto",$nombrePuesto);
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
    <h3 class="text-info">Datos del puesto</h3>
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
              <label for="nombrePuesto" class="form-label">Nombre del puesto</label>
              <input type="text" value="<?php echo $nombrePuesto; ?>"
                     class="form-control" name="nombrePuesto" id="nombrePuesto" 
                     aria-describedby="helpId" placeholder="Nombre del puesto">
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