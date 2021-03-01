<?php
require_once "_com/_varios.php";
require_once "_com/DAO.php";

$id = (int)$_REQUEST["id"];
DAO::personaEstablecerEstadoEstrella($id);

redireccionar("personaListado.php");
?>