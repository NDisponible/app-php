<?php 
include("../../bd.php");
if(isset($_GET['id'])) {
    $id = (isset($_GET['id']))?$_GET['id']:"";
    $sentencia = $conexion->prepare("SELECT *,(SELECT nombrePuesto FROM puestos WHERE 
    puestos.id=empleados.idPuesto limit 1) as puesto FROM empleados WHERE id=:id");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $primerNombre = $registro["primerNombre"];
    $segundoNombre = $registro["segundoNombre"];
    $primerApellido = $registro["primerApellido"];
    $segundoApellido = $registro["segundoApellido"];
    $nombreCompleto = $primerNombre." ".$segundoNombre." ".$primerApellido." ".$segundoApellido;
    $foto = $registro["foto"];
    $cv = $registro["cv"];
    $idPuesto = $registro["idPuesto"];
    $puesto = $registro["puesto"];
    $fechaRegistro = $registro["fechaRegistro"];

    $fechaInicio = new DateTime($fechaRegistro);
    $fechaFin = new DateTime(date('Y-m-d'));
    $diferencia = date_diff($fechaInicio,$fechaFin);
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendación</title>
</head>
<body>
    <h1>Carta de recomendación laboral</h1><br/><br/>
    Madrid, España a <strong><?php echo date('d M Y'); ?></strong><br/><br/>
    A quien pueda interesar:
    <br/><br/>
    Reciba un cordial y respetuoso saludo.
    <br/><br/>
    Esta carta de recomendación es para <strong><?php echo $nombreCompleto; ?></strong>. Trabajó en la empresa durante 
    <strong><?php echo $diferencia->y; ?> año(s)</strong>. Es una excelente persona, con una conducta intachable. Ha demostrado
    ser un/a gran trabajador/a, comprometid/a y responsable. Siempre ha manifestado preocupación 
    por mejorar, capacitarse y actualizar sus conocimientos.
    <br/><br/>
    Durante este tiempo se ha desempeñado como: <strong><?php echo $puesto; ?></strong>.
    Es por ello que le sugiero considere esta recomendación, con la confianza de que estará siempre 
    a la altura de sus compromisos y responsabilidades.
    <br/><br/>
    Sin más nada a que referirme y esperando que esta misiva sea tomada en cuenta, dejo mi número de contacto
    para cualquier información de interés. 
    <br/><br/><br/><br/><br/><br/>
    ___________________<br/>
    Atentamente, 
    <br/><br/>
    Ing. Juan Prieto Moreno
</body>
</html>
<?php 
$HTML = ob_get_clean();
require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));
$dompdf->setOptions($opciones);
$dompdf->loadHTML($HTML);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment"=>false));
?>