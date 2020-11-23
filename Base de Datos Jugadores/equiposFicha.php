<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();


$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $equipoNombre = "";
    $equipoCiudad = "";
    $equipoEstadio = "";
    $equipoEntrenador = "";
    $equipoLigaId = 0;
} else {
    $sqlEquipo = "SELECT * FROM EQUIPOS WHERE ID_EQUIPO=?";

    $jugadoresSql = "SELECT J.ID_JUGADOR AS jId, J.NOMBRE_JUGADOR AS jNombre, J.POSICION_JUGADOR AS jPosicion, J.EDAD_JUGADOR AS jEdad, J.NACIONALIDAD_JUGADOR AS jNacionalidad, J.ESTADO_JUGADOR AS jEstado, J.DORSAL_JUGADOR AS jDorsal, E.ID_EQUIPO AS eId, E.NOMBRE_EQUIPO AS eNombre
        FROM JUGADORES AS J INNER JOIN EQUIPOS AS E ON J.EQUIPO = E.ID_EQUIPO
        WHERE E.ID_EQUIPO=?
        ORDER BY J.POSICION_JUGADOR, J.DORSAL_JUGADOR";

    $select = $conexion->prepare($sqlEquipo);
    $select->execute([$id]);
    $rsEquipo = $select->fetchAll();

    $select = $conexion->prepare($jugadoresSql);
    $select->execute([$id]);
    $rs2 = $select->fetchAll();

    $equipoNombre = $rsEquipo[0]["NOMBRE_EQUIPO"];
    $equipoCiudad = $rsEquipo[0]["CIUDAD_EQUIPO"];
    $equipoEstadio = $rsEquipo[0]["ESTADIO_EQUIPO"];
    $equipoEntrenador = $rsEquipo[0]["ENTRENADOR_EQUIPO"];
    $equipoLigaId = $rsEquipo[0]["LIGA"];
}

$sqlLigas = "SELECT * FROM LIGAS ORDER BY NOMBRE_LIGA";

$select = $conexion->prepare($sqlLigas);
$select->execute([]);
$rsLigas = $select->fetchAll();

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

    .botonAzul {
        padding: 4px 25px;
        background: #4169E1;
        border: 1px solid #000000;
        color: #FFFFFF;
        border-radius: 4px;
        text-decoration:none;
        font-weight: bold;
    }

    .botonAzul:hover {
        padding: 4px 25px;
        background: #4682B4;
        border: 1px solid #000000;
        color: #FFFFFF;
        border-radius: 4px;
        text-decoration:none;
    }
</style>

<body>

<?php if ($nuevaEntrada) { ?>
    <fieldset style='width: 470px'><legend><h1>Nueva ficha de Equipo</h1></legend>
<?php } else { ?>
    <fieldset style='width: 470px'><legend><h1>Ficha de Equipo</h1></legend>
<?php } ?>

<form method='post' action='equiposGuardar.php'>

    <input type='hidden' name='id' value='<?= $id ?>' />

    <label for='nombre'>Nombre: </label>
    <input type='text' name='nombre' value='<?=$equipoNombre?>' required /><br>

    <label for='ciudad'> Ciudad: </label>
    <input type='text' name='ciudad' value='<?=$equipoCiudad?>' required /><br>

    <label for='estadio'>Estadio: </label>
    <input type='text' name='estadio' value='<?=$equipoEstadio?>' required /><br>

    <label for='entrenador'>Entrenador: </label>
    <input type='text' name='entrenador' value='<?=$equipoEntrenador?>' required /><br>

    <label for='liga'>Liga: </label>
    <select name='ligaId'>
        <?php
        foreach ($rsLigas as $filaLigas) {
            $ligaId = (int) $filaLigas["ID_LIGA"];
            $ligaNombre = $filaLigas["NOMBRE_LIGA"];

            if ($filaLigas["ID_LIGA"] == $equipoLigaId) { ?>
                <option value='<?=$ligaId?>' selected='true'><?=$ligaNombre?></option>
                <?php
            } else {?>
                <option value='<?=$ligaId?>'><?=$ligaNombre?></option>
                <?php
            }
        }
        ?>
    </select><br><br>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear Equipo' />
        </fieldset>
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    </fieldset>
    <h2>Lista de Jugadores</h2>
    <table border='1' style='border-collapse: collapse; width: 500px'>

        <tr>
            <th style='background: #DCDCDC'>Dorsal</th>
            <th style='background: #DCDCDC'>Nombre</th>
            <th style='background: #DCDCDC'>Edad</th>
            <th style='background: #DCDCDC'>Posición</th>
            <th style='background: #DCDCDC'>Nacionalidad</th>
            <th style='background: #DCDCDC'>Borrar</th>
        </tr>
    <?php foreach ($rs2 as $fila) { ?>
        <tr>
            <td style='text-align: center; background: #4169E1; color: #FFFFFF; font-weight: bold'><?=$fila["jDorsal"] ?></td>
            <td style='text-align: center'><a href='jugadoresFicha.php?id=<?=$fila["jId"]?>'><?=$fila["jNombre"] ?></a></td>
            <td style='text-align: center'><?=$fila["jEdad"] ?></td>
            <?php
            switch($fila["jPosicion"]){
                case 1: $urlPosicion = "img/iconoPosiciones/portero.png";
                    break;
                case 2: $urlPosicion = "img/iconoPosiciones/central.png";
                    break;
                case 3: $urlPosicion = "img/iconoPosiciones/laterali.png";
                    break;
                case 4: $urlPosicion = "img/iconoPosiciones/laterald.png";
                    break;
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
            <td style='text-align: center'><?=$fila["jNacionalidad"] ?></td>
            <td style='text-align: center'><a href='jugadorEliminar.php?id=<?=$fila["jId"]?>'> (X) </a></td>
        </tr>
    <?php } ?>
    </table>
</form><br>

    <a href='equiposEliminar.php?id=<?=$id?>' class='botonAzul'>Eliminar Equipo</a>
    <?php } ?>

<br>
<br>

<a href='equiposListado.php' class='boton'>Lista de Equipos</a>
<a href='jugadoresListado.php' class='boton'>Lista de Jugadores</a>
<a href='ligasListado.php' class='boton'>Lista de Ligas</a>

</body>


