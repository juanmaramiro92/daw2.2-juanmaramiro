<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$edad = $_REQUEST["edad"];
$posicion = $_REQUEST["posicion"];
$nacionalidad = $_REQUEST["nacionalidad"];
$dorsal = $_REQUEST["dorsal"];
$estado = isset($_REQUEST["estado"]);
$equipoId = (int)$_REQUEST["equipoId"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $sql = "INSERT INTO JUGADORES (EQUIPO, NOMBRE_JUGADOR, POSICION_JUGADOR, NACIONALIDAD_JUGADOR, EDAD_JUGADOR, DORSAL_JUGADOR, ESTADO_JUGADOR) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $parametros = [$equipoId, $nombre, $posicion, $nacionalidad, $edad, $dorsal, $estado];
} else {
    $sql = "UPDATE JUGADORES SET EQUIPO=?, NOMBRE_JUGADOR=?, POSICION_JUGADOR=?, NACIONALIDAD_JUGADOR=?, EDAD_JUGADOR=?, DORSAL_JUGADOR=?, ESTADO_JUGADOR=? WHERE ID_JUGADOR=?";
    $parametros = [$equipoId, $nombre, $posicion, $nacionalidad, $edad, $dorsal, $estado, $id];
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
    <p>No se han podido guardar los datos del Jugador.</p>

    <?php
}
?>

<a href='jugadoresListado.php'>Volver al listado de Jugadores.</a>

</body>

</html>

