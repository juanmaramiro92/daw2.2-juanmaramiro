<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$sql = "SELECT p.id, p.nombre, p.apellido, p.telefono, c.id AS cId, c.nombre AS cNombre FROM persona p INNER JOIN categoria c ON p.categoria_id = c.id ORDER BY p.nombre";

$select = $conexionBD->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Listado de Personas</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Teléfono</th>
        <th>Categoria</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href='personaFicha.php?id=<?=$fila["id"]?>'><?=$fila["nombre"] ?></a></td>
            <td><a href='personaFicha.php?id=<?=$fila["id"]?>'><?=$fila["apellido"] ?></a></td>
            <td><a href='personaFicha.php?id=<?=$fila["id"]?>'><?=$fila["telefono"] ?></a></td>
            <td><a href='categoriaFicha.php?id=<?=$fila["cId"]?>'><?=$fila["cNombre"] ?></a></td>
            <td><a href='personaEliminar.php?id=<?=$fila["id"]?>'> (X) </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href='personaFicha.php?id=-1'>Crear entrada</a>

<br />
<br />

<a href='categoriaListado.php'>Gestionar listado de Categorias</a>

</body>

</html>