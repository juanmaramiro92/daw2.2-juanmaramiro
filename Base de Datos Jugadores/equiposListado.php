<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$sql = "SELECT E.ID_EQUIPO AS eId, E.NOMBRE_EQUIPO AS eNombre, E.CIUDAD_EQUIPO AS eCiudad, E.ESTADIO_EQUIPO AS eEstadio, E.ENTRENADOR_EQUIPO AS eEntrenador, L.ID_LIGA AS lId, L.NOMBRE_LIGA AS lNombre
        FROM EQUIPOS AS E INNER JOIN LIGAS AS L ON E.LIGA = L.ID_LIGA
        ORDER BY L.NOMBRE_LIGA, E.NOMBRE_EQUIPO";

$select = $conexion->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>



<html lang="es-ES">

<head>
    <meta charset='UTF-8'>
</head>

<style>
    .boton {
        padding: 4px 25px;
        background: #DCDCDC;
        border: 1px solid #000000;
        color: #000000;
        border-radius: 4px;
        text-decoration:none;
        font-weight: bold;
    }

    .boton:hover {
        padding: 4px 25px;
        background: #D3D3D3;
        border: 1px solid #000000;
        color: #000000;
        border-radius: 4px;
        text-decoration:none;
    }

</style>

<body>

<h1>Listado de Equipos</h1>
<a href='equiposFicha.php?id=-1' class='boton'>Añadir Equipo</a>
<a href='ligasListado.php' class='boton'>Lista de Ligas</a>
<a href='jugadoresListado.php' class='boton'>Lista de Jugadores</a><br><br>

<table border='1' style='border-collapse: collapse'>

    <tr>
        <th style='background: #DCDCDC'>Nombre</th>
        <th style='background: #DCDCDC'>Ciudad</th>
        <th style='background: #DCDCDC'>Estadio</th>
        <th style='background: #DCDCDC'>Entrenador</th>
        <th style='background: #DCDCDC'>Liga</th>
        <th style='background: #DCDCDC'>Borrar</th>
    </tr>

    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td style='text-align: center; padding: 10px'><a href='equiposFicha.php?id=<?=$fila["eId"]?>'><?= $fila["eNombre"] ?></a></td>
            <td style='text-align: center; padding: 10px; background: #F5F5F5'><?= $fila["eCiudad"] ?></td>
            <td style='text-align: center; padding: 10px'><a href='https://www.google.com/search?q=<?=$fila["eEstadio"]?>'><?= $fila["eEstadio"] ?></a></td>
            <td style='text-align: center; padding: 10px; background: #F5F5F5'><a href='https://www.google.com/search?q=<?=$fila["eEntrenador"]?>'><?= $fila["eEntrenador"] ?></a></td>
            <td style='text-align: center; padding: 10px'><a href='ligasFicha.php?id=<?=$fila["lId"]?>'><?= $fila["lNombre"] ?></a></td>
            <td style='text-align: center; padding: 10px; background: #F5F5F5'><a href='equiposEliminar.php?id=<?=$fila["eId"]?>'>(X)</a></td>
        </tr>
    <?php } ?>

</table>

</body>

</html>
