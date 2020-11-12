<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$sql = "SELECT p.id AS pId, p.nombre AS pNombre, p.apellidos AS pApellidos, p.telefono AS pTelefono, p.estrella AS pEstrella, c.id AS cId, c.nombre AS cNombre 
        FROM persona AS p INNER JOIN categoria AS c ON p.categoriaId = c.id
        ORDER BY p.nombre";

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
        <th>Favorito</th>
        <th>Borrar</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr>
            <td style='text-align: center'><a href='personaFicha.php?id=<?=$fila["pId"]?>'><?=$fila["pNombre"] ?></a></td>
            <td style='text-align: center'><a href='personaFicha.php?id=<?=$fila["pId"]?>'><?=$fila["pApellidos"] ?></a></td>
            <td style='text-align: center'><a href='personaFicha.php?id=<?=$fila["pId"]?>'><?=$fila["pTelefono"] ?></a></td>
            <td style='text-align: center'><a href='categoriaFicha.php?id=<?=$fila["cId"]?>'><?=$fila["cNombre"] ?></a></td>
            <?php
            if ($fila["pEstrella"]) {
                $urlImagen = "img/estrellaRellena.png";
            } else {
                $urlImagen = "img/estrellaVacia.png";
            }
            echo " <td style='text-align: center'><img src='$urlImagen' width='16' height='16'></td>";
            ?>
            <td style='text-align: center'><a href='personaEliminar.php?id=<?=$fila["pId"]?>'> (X) </a></td>
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