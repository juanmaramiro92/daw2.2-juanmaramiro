<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$sql = "DELETE FROM persona WHERE id=?";

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
    <p>Se ha eliminado correctamente la persona.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación no realizada</h1>
    <p>No existe la persona que se pretende eliminar (quizá la eliminaron en paralelo o, ¿ha manipulado Vd. el parámetro id?).</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar la persona.</p>

<?php } ?>

<a href='personaListado.php'>Volver al listado de personas.</a>

</body>

</html>
