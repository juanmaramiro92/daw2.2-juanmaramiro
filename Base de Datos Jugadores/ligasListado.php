<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$sql = "SELECT ID_LIGA, NOMBRE_LIGA, PAIS_LIGA FROM LIGAS ORDER BY NOMBRE_LIGA";

$select = $conexionBD->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>



<html lang='es-ES'>

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

<h1>Listado de Ligas</h1>
<a href='ligasFicha.php?id=-1' class='boton'>Añadir Liga</a>
<a href='equiposListado.php' class='boton'>Lista de Equipos</a>
<a href='jugadoresListado.php' class='boton'>Lista de Jugadores</a>
<br><br>

<table border='1' style='border-collapse: collapse' width='490px'>

    <tr>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Nombre</th>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Pais</th>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Borrar</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr>
            <td style='text-align: center; padding: 10px'><a href='ligasFicha.php?id=<?=$fila["ID_LIGA"]?>'><?=$fila["NOMBRE_LIGA"] ?></a></td>
            <td style='text-align: center; padding: 10px; background: #F5F5F5'><a href='ligasFicha.php?id=<?=$fila["ID_LIGA"]?>'><?=$fila["PAIS_LIGA"] ?></a></td>
            <td style='text-align: center; padding: 10px'><a href='ligasEliminar.php?id=<?=$fila["ID_LIGA"]?>'>(X)</a></td>
        </tr>
    <?php } ?>

</table>

</body>

</html>
