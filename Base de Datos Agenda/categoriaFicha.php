<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una categoría existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
    $categoriaNombre = "";
} else { // Quieren VER la ficha de una categoría existente, cuyos datos se cargan.
    $sql = "SELECT nombre FROM categoria WHERE id=?";

    $miembrosSql = "SELECT p.id AS pId, p.nombre AS pNombre, p.apellidos AS pApellidos, c.id AS cId, c.nombre AS cNombre 
        FROM persona AS p INNER JOIN categoria AS c ON p.categoriaId = c.id
        WHERE c.id=?
        ORDER BY p.nombre";

    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $rs = $select->fetchAll();

    $select2 = $conexion->prepare($miembrosSql);
    $select2->execute([$id]);
    $rs2 = $select2->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $categoriaNombre = $rs[0]["nombre"];
}



// INTERFAZ:
// $nuevaEntrada
// $categoriaNombre
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha de categoría</h1>
<?php } else { ?>
    <h1>Ficha de categoría</h1>
<?php } ?>

<form method='post' action='categoriaGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <ul>
        <li>
            <strong>Nombre: </strong>
            <input type='text' name='nombre' value='<?=$categoriaNombre?>' placeholder='<Inserte nombre>'/>
        </li>
    </ul>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear categoría' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
        <h2>Miembros</h2>
        <?php foreach ($rs2 as $fila) { ?>
            <ul>
                <li><a href='personaFicha.php?id=<?=$fila["pId"]?>'><?=$fila["pNombre"] ?></a>
                    <a href='personaFicha.php?id=<?=$fila["pId"]?>'><?=$fila["pApellidos"] ?></a>
                    <a href='personaEliminar.php?id=<?=$fila["pId"]?>'> (X) </a></li>
            </ul>
        <?php } ?>
        <a href='categoriaEliminar.php?id=<?=$id?>'>Eliminar categoría</a>
    <?php } ?>

</form>

<a href='categoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>
