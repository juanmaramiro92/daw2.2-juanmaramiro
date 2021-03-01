<?php

require_once "_com/DAO.php";

if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("./SesionInicioFormulario.php");

$destinatarioId = isset($_REQUEST["destinatarioId"]) ? $_REQUEST["destinatarioId"] : $_SESSION["id"];

$publicaciones = DAO::obtenerPublicacionesDestinatario($destinatarioId);

?>


<html lang='es-ES'>

<head>
    <meta charset='UTF-8'>
    <title>Mini Facebook</title>
</head>

<body>

<?php DAO::pintarInfoSesion(); ?>

<h1>Muro de <?= DAO::obtenerNombreUsuarioPorId($destinatarioId); ?></h1>

<form method='post' action='PublicacionNuevaCrear.php?destinatarioId=<?= $destinatarioId ?>'>
    <p>¿Cómo te sientes hoy?</p>
    <label for='asunto'>Asunto: </label>
    <input type='text' id='asunto' name='asunto' required>
    <label for='contenido'>Contenido: </label>
    <input type='text' id='contenido' name='contenido' required>
    <button type='submit'>Enviar</button>
</form>

<table>
    <tr>
        <th>Fecha</th>
        <th>Usuario</th>
        <th>Asunto</th>
        <th>Contenido</th>
    </tr>
    <?php foreach ($publicaciones as $p) { ?>
        <?php $destacada = DAO::comprobarPublicacionDestacada($p->getDestacadaHasta());
        if ($destacada) { ?>
            <tr class='negrita'>
        <?php } else { ?>
            <tr>
        <?php } ?>
                <td><?= $p->getFecha() ?></td>
                <td>
                    <a href='MuroVerDe.php?destinatarioId=<?= $p->getEmisorId() ?>'><?= DAO::obtenerNombreUsuarioPorId($p->getEmisorId()); ?></a>
                </td>
                <td><?= $p->getAsunto(); ?></td>
                <td><?= $p->getContenido(); ?></td>
        <?php if ($destinatarioId == $_SESSION["id"] || $p->getEmisorId() == $_SESSION["id"]) { ?>
                <td>
                    <a href='PublicacionEliminar.php?id=<?= $p->getId() ?>&emisorId=<?= $p->getEmisorId() ?>'>Eliminar</a>
                </td>
        <?php } ?>
            </tr>
    <?php } ?>
</table>

<br><br>

<a href='Index.php'>Ver Portada</a>

<a href='MuroVerGlobal.php'>Ver Muro Global</a>

</body>

</html>