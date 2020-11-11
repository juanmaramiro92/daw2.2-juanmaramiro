<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $personaNombre = "";
    $personaApellido = "";
    $personaTelefono = "";
    $personaEstrella = false;
    $personaCategoriaId = 0;
} else {
    $sqlPersona = "SELECT * FROM persona WHERE id=?";

    $select = $conexion->prepare($sqlPersona);
    $select->execute([$id]);
    $rsPersona = $select->fetchAll();

    $personaNombre = $rsPersona[0]["nombre"];
    $personaApellido = $rsPersona[0]["apellidos"];
    $personaTelefono = $rsPersona[0]["telefono"];
    $personaEstrella = ($rsPersona[0]["estrella"] == 1);
    $personaCategoriaId = $rsPersona[0]["categoriaId"];

}

$sqlCategoria = "SELECT * FROM categoria ORDER BY nombre";
$select = $conexion->prepare($sqlCategoria);
$select->execute([]);
$rsCategoria = $select->fetchAll();

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha de persona</h1>
<?php } else { ?>
    <h1>Ficha de persona</h1>
<?php } ?>

<form method='post' action='personaGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <label for='nombre'>Nombre: </label>
    <input type='text' name='nombre' value='<?=$personaNombre?>' /><br>

    <label for='apellidos'> Apellidos: </label>
    <input type='text' name='apellidos' value='<?=$personaApellido?>' /><br>

    <label for='telefono'> Teléfono: </label>
    <input type='text' name='telefono' value='<?=$personaTelefono?>' /><br>

    <label for='pep'>Categoría: </label>

        <select name='categoriaId'>
            <?php
            foreach ($rsCategoria as $filaCategoria) {
                $categoriaId = (int) $filaCategoria["id"];
                $categoriaNombre = $filaCategoria["nombre"];

                if ($filaCategoria["id"] == $personaCategoriaId) { ?>
                    <option value='<?=$categoriaId?>' selected><?=$categoriaNombre?></option>
                <?php
                } else {?>
                    <option value='<?=$categoriaId?>'><?=$categoriaNombre?></option>
                <?php
                }
            }
            ?>
        </select><br>

    <label for='estrella'>Favorito: </label>
    <input type='checkbox' name='estrella' <?= $personaEstrella ? "checked" : "" ?> /><br><br>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear persona' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<br />

<a href='personaEliminar.php?id=<?=$id?>'>Eliminar persona</a>

<br />
<br />

<a href='personaListado.php'>Volver al listado de personas.</a>

</body>

</html>
