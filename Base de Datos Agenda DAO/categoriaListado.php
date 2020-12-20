<?php
require_once "DAO.php";

$categorias = DAO::categoriaObtenerTodas();
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Listado de Categorías</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
    </tr>

    <?php foreach ($categorias as $categoria) { ?>
        <tr>
            <td><a href='categoriaFicha.php?id=<?=$categoria->getId()?>'> <?=$categoria->getNombre()?> </a></td>
            <td><a href='categoriaEliminar.php?id=<?=$categoria->getId()?>'> (X) </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href='categoriaFicha.php?id=-1'>Crear entrada</a>

<br />
<br />

<a href='personaListado.php'>Gestionar listado de Personas</a>

</body>

</html>