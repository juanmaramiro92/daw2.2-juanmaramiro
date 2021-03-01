<?php

require_once "_com/DAO.php";

// TODO ...$_REQUEST["..."]...

// TODO Intentar guardar (añadir funciones en Varios.php para crear y tal).

// TODO Y redirigir a donde sea.

$correcto = DAO::actualizarUsuarioEnBD($arrayUsuario);

// TODO ¿Excepciones?

if ($correcto) {

} else {

}