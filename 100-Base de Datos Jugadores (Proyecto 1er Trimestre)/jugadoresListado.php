<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$lesionados = (isset($_REQUEST["lesionados"]));

if ($lesionados){
    $sqlLesionados = "WHERE J.ESTADO_JUGADOR = 1";
} else {
    $sqlLesionados = "";
}

$sql = "SELECT J.ID_JUGADOR AS jId, J.NOMBRE_JUGADOR AS jNombre, J.POSICION_JUGADOR AS jPosicion, J.NACIONALIDAD_JUGADOR AS jNacionalidad, J.EDAD_JUGADOR AS jEdad, J.DORSAL_JUGADOR AS jDorsal, J.ESTADO_JUGADOR AS jEstado, E.ID_EQUIPO AS eId, E.NOMBRE_EQUIPO AS eNombre
        FROM JUGADORES AS J INNER JOIN EQUIPOS AS E ON J.EQUIPO = E.ID_EQUIPO
        $sqlLesionados
        ORDER BY J.POSICION_JUGADOR, E.NOMBRE_EQUIPO, J.DORSAL_JUGADOR";

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

<?php if (!$lesionados){ ?>
    <h1>Listado de Jugadores</h1>
    <a href='jugadoresFicha.php?id=-1' class='boton'>Añadir Jugador</a>
    <a href='jugadoresListado.php?lesionados' class='boton'>Ver jugadores lesionados</a>
    <a href='equiposListado.php' class='boton'>Lista de Equipos</a>
    <a href='ligasListado.php' class='boton'>Lista de Ligas</a>
    <br><br>
<?php } else { ?>
    <h1>Listado de Jugadores Lesionados</h1>
    <a href='jugadoresFicha.php?id=-1' class='boton'>Añadir Jugador</a>
    <a href='jugadoresListado.php?' class='boton'>Ver todos</a>
    <a href='equiposListado.php' class='boton'>Lista de Equipos</a>
    <a href='ligasListado.php' class='boton'>Lista de Ligas</a>
    <br><br>
<?php } ?>

<table border='1' style='border-collapse: collapse'>

    <tr>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Nombre</th>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Edad</th>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Posición</th>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Nacionalidad</th>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Dorsal</th>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Estado</th>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Equipo</th>
        <th style='background: #DCDCDC; padding: 0px 10px 0px 10px'>Borrar</th>
    </tr>

    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td style='text-align: center; padding: 0px 10px 0px 10px'><a href='jugadoresFicha.php?id=<?=$fila["jId"]?>'><?= $fila["jNombre"] ?></a></td>
            <td style='text-align: center; background: #F5F5F5'><?= $fila["jEdad"] ?></td>
            <?php
            switch($fila["jPosicion"]){
                case 1: $urlPosicion = "img/iconoPosiciones/portero.png";  break;
                case 2: $urlPosicion = "img/iconoPosiciones/central.png";  break;
                case 3: $urlPosicion = "img/iconoPosiciones/laterali.png"; break;
                case 4: $urlPosicion = "img/iconoPosiciones/laterald.png"; break;
                case 5: $urlPosicion = "img/iconoPosiciones/pivote.png";
                break;
                case 6: $urlPosicion = "img/iconoPosiciones/mediocentro.png";
                break;
                case 7: $urlPosicion = "img/iconoPosiciones/interiori.png";
                break;
                case 8: $urlPosicion = "img/iconoPosiciones/interiord.png";
                break;
                case 9: $urlPosicion = "img/iconoPosiciones/mediapunta.png";
                break;
                case 10: $urlPosicion = "img/iconoPosiciones/extremoi.png";
                break;
                case 11: $urlPosicion = "img/iconoPosiciones/extremod.png";
                break;
                case 12: $urlPosicion = "img/iconoPosiciones/delantero.png";
            }
            echo "<td style='text-align: center'><img src='$urlPosicion' width='30' height='18'></td>";
            ?>
            <td style='text-align: center; background: #F5F5F5'><?= $fila["jNacionalidad"] ?></td>
            <td style='text-align: center'><?= $fila["jDorsal"] ?></td>
            <?php
            $urlImagen = $fila["jEstado"] ? "img/iconoLesiones/lesionado.png" : "img/iconoLesiones/disponible.png";
            echo "<td style='text-align: center; padding: 10px; background: #F5F5F5'><a href='jugadoresEstablecerEstado.php?id=$fila[jId]'><img src='$urlImagen' width='16' height='16'></a></td>";
            ?>
            <td style='text-align: center; padding: 0px 10px 0px 10px'><a href='equiposFicha.php?id=<?=$fila["eId"]?>'><?= $fila["eNombre"] ?></a></td>
            <td style='text-align: center; background: #F5F5F5'><a href='jugadoresEliminar.php?id=<?=$fila["jId"]?>'>(X)</a></td>
        </tr>
    <?php } ?>

</table>

</body>

</html>

