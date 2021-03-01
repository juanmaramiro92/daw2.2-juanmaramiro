<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $jugadorNombre = "";
    $jugadorPosicion = "";
    $jugadorNacionalidad = "";
    $jugadorEdad = "";
    $jugadorDorsal = "";
    $jugadorEstado = false;
    $jugadorEquipoId = 0;
} else {
    $sqlEquipo = "SELECT * FROM JUGADORES WHERE ID_JUGADOR=?";

    $select = $conexion->prepare($sqlEquipo);
    $select->execute([$id]);
    $rsJugador = $select->fetchAll();

    $jugadorNombre = $rsJugador[0]["NOMBRE_JUGADOR"];
    $jugadorPosicion = $rsJugador[0]["POSICION_JUGADOR"];
    $jugadorNacionalidad = $rsJugador[0]["NACIONALIDAD_JUGADOR"];
    $jugadorEdad = $rsJugador[0]["EDAD_JUGADOR"];
    $jugadorDorsal = $rsJugador[0]["DORSAL_JUGADOR"];
    $jugadorEstado = $rsJugador[0]["ESTADO_JUGADOR"] == 1;
    $jugadorEquipoId = $rsJugador[0]["EQUIPO"];
}

$sqlEquipos = "SELECT * FROM EQUIPOS ORDER BY NOMBRE_EQUIPO";

$select = $conexion->prepare($sqlEquipos);
$select->execute([]);
$rsEquipos = $select->fetchAll();

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
    <fieldset style='width: 470px'><legend><h1>Nueva ficha de Jugador</h1></legend>
<?php } else { ?>
    <fieldset style='width: 470px'><legend><h1>Ficha de Jugador</h1></legend>
<?php } ?>

<form method='post' action='jugadoresGuardar.php'>

    <input type='hidden' name='id' value='<?= $id ?>' />

    <label for='nombre'>Nombre: </label>
    <input type='text' name='nombre' value='<?=$jugadorNombre?>' required /><br>

    <label for='edad'> Edad: </label>
    <input type='text' name='edad' value='<?=$jugadorEdad?>' required /><br>

    <label for='nacionalidad'>Nacionalidad: </label>
    <input type='text' name='nacionalidad' value='<?=$jugadorNacionalidad?>' required /><br>

    <label for='posicion'>Posición: </label>
    <select name='posicion'>
        <?php
        if ($jugadorPosicion == 1){ ?>
            <option value='1' selected>Portero</option>
        <?php
        } else {?>
            <option value='1'>Portero</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 2){ ?>
            <option value='2' selected>Defensa Central</option>
            <?php
        } else {?>
            <option value='2'>Defensa Central</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 3){ ?>
            <option value='3' selected>Lateral Izq.</option>
            <?php
        } else {?>
            <option value='3'>Lateral Izq.</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 4){ ?>
            <option value='4' selected>Lateral Der.</option>
            <?php
        } else {?>
            <option value='4'>Lateral Der.</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 5){ ?>
            <option value='5' selected>Pivote</option>
            <?php
        } else {?>
            <option value='5'>Pivote</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 6){ ?>
            <option value='6' selected>Mediocentro</option>
            <?php
        } else {?>
            <option value='6'>Mediocentro</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 7){ ?>
            <option value='7' selected>Interior Izq.</option>
            <?php
        } else {?>
            <option value='7'>Interior Izq.</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 8){ ?>
            <option value='8' selected>Interior Der.</option>
            <?php
        } else {?>
            <option value='8'>Interior Der.</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 9){ ?>
            <option value='9' selected>Mediapunta</option>
            <?php
        } else {?>
            <option value='9'>Mediapunta</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 10){ ?>
            <option value='10' selected>Extremo Izq.</option>
            <?php
        } else {?>
            <option value='10'>Extremo Izq.</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 11){ ?>
            <option value='11' selected>Extremo Der.</option>
            <?php
        } else {?>
            <option value='11'>Extremo Der.</option>
        <?php } ?>
        <?php
        if ($jugadorPosicion == 12){ ?>
            <option value='12' selected>Delantero Centro</option>
            <?php
        } else {?>
            <option value='12'>Delantero Centro</option>
        <?php } ?>
    </select><br>

    <label for='equipo'>Equipo: </label>
    <select name='equipoId'>
        <?php
        foreach ($rsEquipos as $filaEquipos) {
            $equipoId = (int) $filaEquipos["ID_EQUIPO"];
            $equipoNombre = $filaEquipos["NOMBRE_EQUIPO"];

            if ($filaEquipos["ID_EQUIPO"] == $jugadorEquipoId) { ?>
                <option value='<?=$equipoId?>' selected='true'><?=$equipoNombre?></option>
            <?php
            } else {?>
                <option value='<?=$equipoId?>'><?=$equipoNombre?></option>
                <?php
            }
        }
        ?>
    </select>

    <label for='dorsal'>Dorsal: </label>
    <select name='dorsal'>
        <?php
        for ($i = 1; $i <= 99; $i++){
            if ($i == $jugadorDorsal){?>
                <option value='<?=$i?>' selected><?=$i?></option>
            <?php
            } else{ ?>
                <option value='<?=$i?>'><?=$i?></option>
                <?php }
                }?>
    </select><br>

    <label for='estado'>¿Lesionado?</label>
    <input type='checkbox' name='estado' <?= $jugadorEstado ? "checked" : "" ?> /><br><br>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear Jugador' />
    </fieldset>

    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
</fieldset>
    <?php } ?>

        </form>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='jugadoresEliminar.php?id=<?=$id?>' class='botonAzul'>Eliminar Jugador</a>
<?php } ?>

<br />
<br />

<a href='jugadoresListado.php' class='boton'>Lista de Jugadores</a>
<a href='equiposListado.php' class='boton'>Lista de Equipos</a>
<a href='ligasListado.php' class='boton'>Lista de Ligas</a>

</body>

