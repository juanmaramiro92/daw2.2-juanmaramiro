
<?php
require_once "_com/_varios.php";
require_once "_com/DAO.php";

if(isset($_REQUEST["soloEstrellas"])) {
    $posibleClausulaWhere= "WHERE estrella=1";
} else if(isset($_REQUEST["sinEstrellas"])) {
    $posibleClausulaWhere= "WHERE estrella=0";
} else {
    $posibleClausulaWhere= "";
}

$personas = DAO::personaObtenerTodas($posibleClausulaWhere);

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Listado de Personas</h1>

<table border='1' style="text-align: center; border-collapse: collapse">

    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Teléfono</th>
        <th>Estrella</th>
        <th>Categoria</th>
        <th>Borrar</th>
    </tr>

    <?php
    foreach ($personas as $persona) { ?>
        <tr>
            <td><a href="personaFicha.php?id=<?=$persona->getId()?>"><?=$persona->getNombre()?></a></td>
            <td><a href="personaFicha.php?id=<?=$persona->getId()?>"><?=$persona->getApellidos()?></a></td>
            <td><?=$persona->getTelefono()?></td>
    <?php if($persona->getEstrella() == true) { ?>
            <td><a href="personaEstablecerEstadoEstrella.php?id=<?=$persona->getId()?>"><img src="img/estrellaRellena.png" width="15"></a></td>
    <?php } else {?>
            <td><a href="personaEstablecerEstadoEstrella.php?id=<?=$persona->getId()?>"><img src="img/estrellaVacia.png" width="15"></a></td>
    <?php } ?>
            <td><a href='categoriaFicha.php?id=<?=$persona->getCategoriaId()?>'><?= DAO::personaCategoria($persona->getCategoriaId())?></a></td>
            <td><a href='personaEliminar.php?id=<?=$persona->getId()?>'>(X)</a></td>
        </tr>
    <?php } ?>

</table>

<br />

<?php if (!isset($_REQUEST["soloEstrellas"])) {?>
    <a href='personaListado.php?soloEstrellas'>Mostrar solo contactos con estrella</a>
<?php } else { ?>
    <a href='personaListado.php?todos'>Mostrar todos los contactos</a>
<?php } ?>

<br />
<br />

<a href='personaFicha.php?id=-1'>Crear entrada</a>

<br />
<br />

<a href='categoriaListado.php'>Gestionar listado de Categorías</a>

</body>

</html>