<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$ciudad = $_REQUEST["ciudad"];
$estadio = $_REQUEST["estadio"];
$entrenador = $_REQUEST["entrenador"];
$ligaId = (int)$_REQUEST["ligaId"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $sql = "INSERT INTO EQUIPOS (LIGA, NOMBRE_EQUIPO, CIUDAD_EQUIPO, ESTADIO_EQUIPO, ENTRENADOR_EQUIPO) VALUES (?, ?, ?, ?, ?)";
    $parametros = [$ligaId, $nombre, $ciudad, $estadio, $entrenador];
} else {
    $sql = "UPDATE EQUIPOS SET LIGA=?, NOMBRE_EQUIPO=?, CIUDAD_EQUIPO=?, ESTADIO_EQUIPO=?, ENTRENADOR_EQUIPO=? WHERE ID_EQUIPO=?";
    $parametros = [$ligaId, $nombre, $ciudad, $estadio, $entrenador, $id];
}

$sentencia = $conexion->prepare($sql);

$sqlConExito = $sentencia->execute($parametros);

$numFilasAfectadas = $sentencia->rowCount();
$unaFilaAfectada = ($numFilasAfectadas == 1);
$ningunaFilaAfectada = ($numFilasAfectadas == 0);

$correcto = ($sqlConExito && $unaFilaAfectada);

$datosNoModificados = ($sqlConExito && $ningunaFilaAfectada);
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php

if ($correcto || $datosNoModificados) { ?>

    <?php if ($id == -1) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?php echo $nombre; ?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?php echo $nombre; ?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos del Equipo.</p>

    <?php
}
?>

<a href='equiposListado.php'>Volver al listado de Equipos.</a>

</body>

</html>
