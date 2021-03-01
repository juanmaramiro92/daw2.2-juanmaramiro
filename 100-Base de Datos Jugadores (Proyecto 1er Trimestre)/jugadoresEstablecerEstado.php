<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$id = $_REQUEST["id"];

$sql = "UPDATE JUGADORES SET ESTADO_JUGADOR = (NOT (SELECT ESTADO_JUGADOR FROM JUGADORES WHERE ID_JUGADOR=?)) WHERE ID_JUGADOR=?";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([$id, $id]);

redireccionar("jugadoresListado.php");
?>
