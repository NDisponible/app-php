<?php 
include("../../bd.php");
if(isset($_GET['id'])) {
    $id = (isset($_GET['id']))?$_GET['id']:"";
    $sentencia = $conexion->prepare("SELECT foto,cv FROM empleados WHERE id=:id");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
    if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!="") {
        if(file_exists("./".$registro_recuperado["foto"])) {
            unlink("./".$registro_recuperado["foto"]);
        }
    }
    if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!="") {
        if(file_exists("./".$registro_recuperado["cv"])) {
            unlink("./".$registro_recuperado["cv"]);
        }
    }
    $sentencia = $conexion->prepare("DELETE FROM empleados WHERE id=:id");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header ("Location:index.php?mensaje=".$mensaje);  
}
$sentencia = $conexion->prepare("SELECT *,(SELECT nombrePuesto FROM puestos WHERE 
             puestos.id=empleados.idPuesto limit 1) as puesto FROM empleados");
$sentencia->execute();
$lista_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
include("../../templates/header.php"); ?>
<br/>
<h3>Empleados</h3>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Añadir registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de registro</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($lista_empleados as $registro) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id']; ?></td>
                        <td scope="row"><?php echo $registro['primerNombre']; ?>
                                        <?php echo $registro['segundoNombre']; ?>
                                        <?php echo $registro['primerApellido']; ?>
                                        <?php echo $registro['segundoApellido']; ?>
                        </td>
                        <td scope="row">
                            <img width="50" height="50" src="<?php echo $registro['foto']; ?>" class="img-fluid rounded" alt="Foto del empleado"/>
                        </td>
                        <td scope="row"><a href="<?php echo $registro['cv']; ?>">
                            <?php echo $registro['cv']; ?></a></td>
                        <td scope="row"><?php echo $registro['puesto']; ?></td>
                        <td scope="row"><?php echo $registro['fechaRegistro']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="cartaRecomendacion.php?id=<?php echo $registro['id']; ?>" role="button">Carta</a> |
                            <a class="btn btn-info" href="editar.php?id=<?php echo $registro['id']; ?>" role="button">Editar</a> |
                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>    
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
<?php include("../../templates/footer.php"); ?>