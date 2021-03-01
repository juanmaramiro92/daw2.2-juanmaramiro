<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$sql = "DELETE FROM LIGAS WHERE ID_LIGA=?";

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
    <p>Se ha eliminado correctamente la Liga.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación no realizada</h1>
    <p>No existe la Liga que se pretende eliminar (quizá la eliminaron en paralelo o, ¿ha manipulado Vd. el parámetro id?).</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar la Liga.</p>

<?php } ?>

<a href='ligasListado.php'>Volver al listado de Ligas.</a>

</body>

</html>

