<?php 
include("../../bd.php");
if ($_POST) {
    $nombrePuesto = (isset($_POST["nombrePuesto"])?$_POST["nombrePuesto"]:"");
    $sentencia = $conexion->prepare("INSERT INTO puestos(id,nombrePuesto) VALUES (null, :nombrePuesto)");
    $sentencia->bindParam(":nombrePuesto",$nombrePuesto);
    $sentencia->execute();
    $mensaje = "Registro añadido";
    header ("Location:index.php?mensaje=".$mensaje);
}
include("../../templates/header.php"); 
?>
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
              <label for="nombrePuesto" class="form-label">Nombre del puesto</label>
              <input type="text" required
                     class="form-control" name="nombrePuesto" id="nombrePuesto" 
                     aria-describedby="helpId" placeholder="Nombre del puesto">
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