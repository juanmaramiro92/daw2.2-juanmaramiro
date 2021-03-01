<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$apellido = $_REQUEST["apellidos"];
$telefono = $_REQUEST["telefono"];
$categoriaId = (int)$_REQUEST["categoriaId"];
$estrella = isset($_REQUEST["estrella"]);

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $sql = "INSERT INTO persona (nombre, apellidos, telefono, estrella, categoriaId) VALUES (?, ?, ?, ?, ?)";
    $parametros = [$nombre, $apellido, $telefono, $estrella?1:0, $categoriaId];
} else {
    $sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=?, estrella=?, categoriaId=? WHERE id=?";
    $parametros = [$nombre, $apellido, $telefono, $estrella?1:0, $categoriaId, $id];
}

$sentencia = $conexionBD->prepare($sql);
$sqlConExito = $sentencia->execute($parametros);

$correcto = ($sqlConExito && $sentencia->rowCount() == 1);

$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php

if ($correcto || $datosNoModificados) { ?>
    <?php if ($nuevaEntrada) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?=$nombre?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?=$nombre?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <?php if ($nuevaEntrada) { ?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear la nueva persona.</p>
    <?php } else { ?>
        <h1>Error en la modificación.</h1>
        <p>No se han podido guardar los datos de la persona.</p>
    <?php } ?>

    <?php
}
?>

<a href='personaListado.php'>Volver al listado de personas.</a>

</body>

</html>