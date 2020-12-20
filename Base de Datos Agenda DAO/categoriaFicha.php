<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $categoriaNombre = "";
} else {
    $sql = "SELECT nombre FROM categoria WHERE id=?";

    $select = $conexion->prepare($sql);
    $select->execute([$id]);
    $rs = $select->fetchAll();

    $categoriaNombre = $rs[0]["nombre"];
}

$sql = "SELECT * FROM persona WHERE categoriaId=? ORDER BY nombre";

$select = $conexion->prepare($sql);
$select->execute([$id]);
$personasCategoria = $select->fetchAll();

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
        <ul>
        <?php foreach ($personasCategoria as $fila) {
            echo "<li>$fila[nombre] $fila[apellidos]</li>";
        } ?>
        </ul>
        <a href='categoriaEliminar.php?id=<?=$id?>'>Eliminar categoría</a>
    <?php } ?>

</form>

<a href='categoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>
