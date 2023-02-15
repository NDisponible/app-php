<?php
include("../../bd.php");
if(isset($_GET['id'])) {
    $id = (isset($_GET['id']))?$_GET['id']:"";
    $sentencia = $conexion->prepare("SELECT * FROM empleados WHERE id=:id");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $primerNombre = $registro["primerNombre"];
    $segundoNombre = $registro["segundoNombre"];
    $primerApellido = $registro["primerApellido"];
    $segundoApellido = $registro["segundoApellido"];
    $foto = $registro["foto"];
    $cv = $registro["cv"];
    $idPuesto = $registro["idPuesto"];
    $fechaRegistro = $registro["fechaRegistro"];

    $sentencia = $conexion->prepare("SELECT * FROM puestos");
    $sentencia->execute();
    $lista_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
}
if ($_POST) {
    $id = (isset($_POST['id']))?$_POST['id']:"";
    $primerNombre = (isset($_POST["primerNombre"])?$_POST["primerNombre"]:"");
    $segundoNombre = (isset($_POST["segundoNombre"])?$_POST["segundoNombre"]:"");
    $primerApellido = (isset($_POST["primerApellido"])?$_POST["primerApellido"]:"");
    $segundoApellido = (isset($_POST["segundoApellido"])?$_POST["segundoApellido"]:"");
    $idPuesto = (isset($_POST['idPuesto']))?$_POST['idPuesto']:"";
    $fechaRegistro = (isset($_POST['fechaRegistro']))?$_POST['fechaRegistro']:"";
    $sentencia = $conexion->prepare("UPDATE empleados SET primerNombre=:primerNombre, 
                 segundoNombre=:segundoNombre, primerApellido=:primerApellido,
                 segundoApellido=:segundoApellido, idPuesto=:idPuesto,
                 fechaRegistro=:fechaRegistro WHERE id=:id");
    $sentencia->bindParam(":primerNombre",$primerNombre);
    $sentencia->bindParam(":segundoNombre",$segundoNombre);
    $sentencia->bindParam(":primerApellido",$primerApellido);
    $sentencia->bindParam(":segundoApellido",$segundoApellido);
    $sentencia->bindParam(":idPuesto",$idPuesto);
    $sentencia->bindParam(":fechaRegistro",$fechaRegistro);
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();

    $foto = (isset($_FILES['foto']['name']))?$_FILES['foto']['name']:"";
    $fecha_ = new DateTime();
    $nombreArchivo_foto = ($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]['name']:"";
    $tmp_foto = $_FILES["foto"]['tmp_name'];
    if($tmp_foto!='') {
      move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);
      $sentencia = $conexion->prepare("SELECT foto,cv FROM empleados WHERE id=:id");
      $sentencia->bindParam(":id",$id);
      $sentencia->execute();
      $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
      if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!="") {
          if(file_exists("./".$registro_recuperado["foto"])) {
              unlink("./".$registro_recuperado["foto"]);
          }
      }  
    $sentencia = $conexion->prepare("UPDATE empleados SET foto=:foto WHERE id=:id");
    $sentencia->bindParam(":foto",$nombreArchivo_foto);
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
  }
    $cv = (isset($_FILES['cv']['name']))?$_FILES['cv']['name']:"";
    $nombreArchivo_cv = ($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]['name']:"";
    $tmp_cv = $_FILES["cv"]['tmp_name'];
    if($tmp_cv!='') {
      move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);
      $sentencia = $conexion->prepare("SELECT cv FROM empleados WHERE id=:id");
      $sentencia->bindParam(":id",$id);
      $sentencia->execute(); 
      $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
      if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!="") {
        if(file_exists("./".$registro_recuperado["cv"])) {
            unlink("./".$registro_recuperado["cv"]);
        }
    }  
      $sentencia = $conexion->prepare("UPDATE empleados SET cv=:cv WHERE id=:id");
      $sentencia->bindParam(":cv",$nombreArchivo_cv);
      $sentencia->bindParam(":id",$id);
      $sentencia->execute();  
    }
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
    <h3 class="text-info">Datos del empleado</h3>
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
              <label for="primerNombre" class="form-label">Primer nombre</label>
              <input type="text" value="<?php echo $primerNombre; ?>"
                     class="form-control" name="primerNombre" id="primerNombre" 
                     aria-describedby="helpId" placeholder="Primer nombre">
            </div>
            <div class="mb-3">
              <label for="segundoNombre" class="form-label">Segundo nombre</label>
              <input type="text" value="<?php echo $segundoNombre; ?>"
                     class="form-control" name="segundoNombre" id="segundoNombre" 
                     aria-describedby="helpId" placeholder="Segundo nombre">
            </div>
            <div class="mb-3">
              <label for="primerApellido" class="form-label">Primer apellido</label>
              <input type="text" value="<?php echo $primerApellido; ?>"
                     class="form-control" name="primerApellido" id="primerApellido" 
                     aria-describedby="helpId" placeholder="Primer apellido">
            </div>
            <div class="mb-3">
              <label for="segundoApellido" class="form-label">Segundo apellido</label>
              <input type="text" value="<?php echo $segundoApellido; ?>"
                     class="form-control" name="segundoApellido" id="segundoApellido" 
                     aria-describedby="helpId" placeholder="Segundo apellido">
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Foto:</label><br/>
              <img width="100" height="100" src="<?php echo $foto; ?>" class="img-fluid rounded" alt="Foto del empleado"/><br/><br/>
              <input type="file" class="form-control" name="foto" id="foto" 
                     aria-describedby="helpId">
            </div>
            <div class="mb-3">
              <label for="cv" class="form-label">CV(PDF):</label><br/>
                  <a href="<?php echo $cv;?>"><?php echo $cv;?></a>
              <input type="file" class="form-control" name="cv" id="cv" 
                     aria-describedby="helpId">
            </div>
            <div class="mb-3">
              <label for="idPuesto" class="form-label">Puesto:</label>
              <select class="form-select form-select-sm" name="idPuesto" id="idPuesto">
                  <?php foreach($lista_puestos as $registro) { ?> 
              <option <?php echo ($idPuesto == $registro['id'])?"selected":" ";?> value="<?php echo $registro['id']; ?>">
                  <?php echo $registro['nombrePuesto']; ?>
              </option>
              <?php } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="fechaRegistro" class="form-label">Fecha de registro:</label>
              <input type="text" value="<?php echo $fechaRegistro; ?>"
                     class="form-control" name="fechaRegistro" id="fechaRegistro" 
                     aria-describedby="helpId" placeholder="Selecciona la fecha de registro">
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