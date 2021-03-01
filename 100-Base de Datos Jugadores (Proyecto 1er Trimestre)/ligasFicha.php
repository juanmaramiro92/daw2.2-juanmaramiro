<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $ligaNombre = "";
    $ligaPais = "";
} else {
    $sql = "SELECT NOMBRE_LIGA, PAIS_LIGA FROM LIGAS WHERE ID_LIGA=?";

    $equiposSql = "SELECT E.ID_EQUIPO AS eId, E.NOMBRE_EQUIPO AS eNombre, E.CIUDAD_EQUIPO AS eCiudad, E.ESTADIO_EQUIPO AS eEstadio, E.ENTRENADOR_EQUIPO AS eEntrenador, L.ID_LIGA AS lId, L.NOMBRE_LIGA AS lNombre, L.PAIS_LIGA AS lPais
                    FROM EQUIPOS AS E INNER JOIN LIGAS AS L ON E.LIGA = L.ID_LIGA
                    WHERE L.ID_LIGA=?
                    ORDER BY E.NOMBRE_EQUIPO";

    $select = $conexion->prepare($sql);
    $select->execute([$id]);
    $rs = $select->fetchAll();

    $select = $conexion->prepare($equiposSql);
    $select->execute([$id]);
    $rs2 = $select->fetchAll();

    $ligaNombre = $rs[0]["NOMBRE_LIGA"];
    $ligaPais = $rs[0]["PAIS_LIGA"];
}

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
    <fieldset style='width: 470px'><legend><h1>Nueva ficha de Liga</h1></legend>
<?php } else { ?>
    <fieldset style='width: 470px'><legend><h1>Ficha de Liga</h1></legend>
<?php } ?>

<form method='post' action='ligasGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <label for='nombre'>Nombre: </label>
    <input type='text' name='nombre' value='<?=$ligaNombre?>' placeholder='<Inserte nombre de liga>' required /><br>

    <label for='pais'>Pais: </label>
    <input type='text' name='pais' value='<?=$ligaPais?>' placeholder='<Inserte pais de liga>' required /><br><br>


    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear Liga' />
    </fieldset>
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
</fieldset>
        </body>
        <h2>Lista de Equipos</h2>
        <table border='1' style='border-collapse: collapse'>

        <tr>
            <th style='background: #DCDCDC'>Nombre</th>
            <th style='background: #DCDCDC'>Borrar</th>
        </tr>
    <?php foreach ($rs2 as $fila) { ?>
        <tr>
            <td style='text-align: center; padding: 0px 10px 0px 10px'><a href='equiposFicha.php?id=<?=$fila["eId"]?>'><?=$fila["eNombre"] ?></a></td>
            <td style='text-align: center; padding: 0px 10px 0px 10px'><a href='equiposEliminar.php?id=<?=$fila["eId"]?>'> (X) </a></td>
        </tr>
    <?php } ?>
        </table>
</form><br>

    <a href='ligasEliminar.php?id=<?=$id?>' class='botonAzul'>Eliminar Liga</a>
    <?php } ?>

<br>
<br>

<a href='ligasListado.php' class='boton'>Lista de Ligas</a>
<a href='equiposListado.php' class='boton'>Lista de Equipos</a>
<a href='jugadoresListado.php' class='boton'>Lista de Jugadores</a>


</body>

</html>
