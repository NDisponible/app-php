<?php 
include("../../bd.php");
if ($_POST) {
  //print_r($_POST);
  //print_r($_FILES);
    $primerNombre = (isset($_POST["primerNombre"])?$_POST["primerNombre"]:"");
    $segundoNombre = (isset($_POST["segundoNombre"])?$_POST["segundoNombre"]:"");
    $primerApellido = (isset($_POST["primerApellido"])?$_POST["primerApellido"]:"");
    $segundoApellido = (isset($_POST["segundoApellido"])?$_POST["segundoApellido"]:"");
    $foto = (isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");
    $cv = (isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");
    $idPuesto = (isset($_POST["idPuesto"])?$_POST["idPuesto"]:"");
    $fechaRegistro = (isset($_POST["fechaRegistro"])?$_POST["fechaRegistro"]:"");

    $sentencia = $conexion->prepare("INSERT INTO empleados(id,primerNombre,segundoNombre,
                 primerApellido,segundoApellido,foto,cv,idPuesto,fechaRegistro) VALUES (NULL, :primerNombre,
                 :segundoNombre,:primerApellido,:segundoApellido,:foto,:cv,:idPuesto,:fechaRegistro)");
    $sentencia->bindParam(":primerNombre",$primerNombre);
    $sentencia->bindParam(":segundoNombre",$segundoNombre);
    $sentencia->bindParam(":primerApellido",$primerApellido);
    $sentencia->bindParam(":segundoApellido",$segundoApellido);

    $fecha_ = new DateTime();
    $nombreArchivo_foto = ($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]['name']:"";
    $tmp_foto = $_FILES["foto"]['tmp_name'];
    if($tmp_foto!='') {
      move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);
    }
    $sentencia->bindParam(":foto",$nombreArchivo_foto);

    $nombreArchivo_cv = ($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]['name']:"";
    $tmp_cv = $_FILES["cv"]['tmp_name'];
    if($tmp_cv!='') {
      move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);
    }
    $sentencia->bindParam(":cv",$nombreArchivo_cv);

    $sentencia->bindParam(":idPuesto",$idPuesto);
    $sentencia->bindParam(":fechaRegistro",$fechaRegistro);
    $sentencia->execute();
    $mensaje = "Registro añadido";
    header ("Location:index.php?mensaje=".$mensaje);
}
$sentencia = $conexion->prepare("SELECT * FROM puestos");
$sentencia->execute();
$lista_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
include("../../templates/header.php"); ?>
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
              <label for="primerNombre" class="form-label">Primer nombre</label>
              <input type="text" class="form-control" name="primerNombre" id="primerNombre" 
                     required placeholder="Primer nombre">
            </div>
            <div class="mb-3">
              <label for="segundoNombre" class="form-label">Segundo nombre</label>
              <input type="text" class="form-control" name="segundoNombre" id="segundoNombre" 
                     placeholder="segundo nombre">
            </div>
            <div class="mb-3">
              <label for="primerApellido" class="form-label">Primer apellido</label>
              <input type="text" class="form-control" name="primerApellido" id="primerApellido" 
                     required placeholder="Primer apellido">
            </div>
            <div class="mb-3">
              <label for="segundoApellido" class="form-label">Segundo apellido</label>
              <input type="text" class="form-control" name="segundoApellido" id="segundoApellido" 
                     placeholder="Segundo Apellido">
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Foto:</label>
              <input type="file" class="form-control" name="foto" id="foto" 
                     required placeholder="foto">
            </div>
            <div class="mb-3">
              <label for="cv" class="form-label">CV(PDF):</label>
              <input type="file" class="form-control" name="cv" id="cv" 
                     required placeholder="CV">
            </div>
            <div class="mb-3">
                <label for="idPuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-sm" name="idPuesto" id="idPuesto" required>
                    <?php foreach($lista_puestos as $registro) { ?>
                    <option value="<?php echo $registro['id']; ?>"><?php echo $registro['nombrePuesto']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
              <label for="fechaRegistro" class="form-label">Fecha de registro</label>
              <input type="date" class="form-control" name="fechaRegistro" id=" fechaRegistro" 
                     required placeholder="Fecha de registro en la empresa">
            </div>
            <button type="submit" class="btn btn-success">Añadir registro</button> |
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    </div>
    </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer.php"); ?>