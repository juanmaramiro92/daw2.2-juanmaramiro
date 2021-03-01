<?php

require_once "DAO.php";

$emisor = $_REQUEST["emisorId"];
$publicacion = $_REQUEST["id"];

if ($emisor = !$_SESSION["id"]) {
    DAO::eliminarPublicacionHaciaMi($publicacion);
} else {
    DAO::eliminarMiPublicacion($publicacion);
}

header('Location:' . getenv('HTTP_REFERER'));