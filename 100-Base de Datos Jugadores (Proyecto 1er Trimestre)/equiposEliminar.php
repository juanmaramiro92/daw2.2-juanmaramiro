<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$sql = "DELETE FROM EQUIPOS WHERE ID_EQUIPO=?";

$sentencia = $conexionBD->prepare($sql);
$sqlConExito = $sentencia->execute([$id]);

$correctoNormal = ($sqlConExito && $sentencia->rowCount() == 1);

$noExistia = ($sqlConExito && $sentencia->rowCount() == 0);

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($correctoNormal) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente el Equipo.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación no realizada</h1>
    <p>No existe el Equipo que se pretende eliminar (quizá la eliminaron en paralelo o, ¿ha manipulado Vd. el parámetro id?).</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar el Equipo.</p>

<?php } ?>

<a href='equiposListado.php'>Volver al listado de Equipos.</a>

</body>

</html>

