<?php
require_once "_com/_varios.php";
require_once "_com/DAO.php";

$id = (int)$_REQUEST["id"];
$datos= DAO::categoriaFicha($id);

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php if ($datos[0] == true) { ?>
    <h1>Nueva ficha de categoría</h1>
<?php } else { ?>
    <h1>Ficha de categoría</h1>
<?php } ?>

<form method='post' action='categoriaGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <label for='nombre'>Nombre</label>
    <input type='text' name='nombre' value='<?=$datos[1]?>' />
    <br/>

    <br/>

    <?php if ($datos[0] == true) { ?>
        <input type='submit' name='crear' value='Crear categoría' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<p>Personas que pertenecen actualmente a la categoría:</p>

<ul>
    <?php
    foreach ($datos[2] as $fila) {
        echo "<li>$fila[nombre] $fila[apellidos]</li>";
    }
    ?>
</ul>

<?php if ($datos[0] == false) { ?>
    <a href='categoriaEliminar.php?id=<?=$id?>'>Eliminar categoría</a>
<?php } ?>

<br />
<br />

<a href='categoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>
