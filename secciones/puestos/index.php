<?php 
include("../../bd.php");
if(isset($_GET['id'])) {
    $id = (isset($_GET['id']))?$_GET['id']:"";
    $sentencia = $conexion->prepare("DELETE FROM puestos WHERE id=:id");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header ("Location:index.php?mensaje=".$mensaje);
}
$sentencia = $conexion->prepare("SELECT * FROM puestos");
$sentencia->execute();
$lista_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
include("../../templates/header.php"); ?>
<br/>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Añadir puesto</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre del puesto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lista_puestos as $registro) { ?>
            <tr class="">
                <td scope="row"><?php echo $registro['id']; ?></td>
                <td><?php echo $registro['nombrePuesto']; ?></td>
                <td>
                    <a name="" id="" class="btn btn-info" href="editar.php?id=<?php echo $registro['id']; ?>" role="button">Editar</a> |
                    <a name="" id="" class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
 </div>
</div>
</div>
<?php include("../../templates/footer.php"); ?>