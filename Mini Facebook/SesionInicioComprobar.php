<?php

require_once "_Varios.php";

$arrayUsuario = obtenerUsuario($_REQUEST["identificador"], $_REQUEST["contrasenna"]);

if ($arrayUsuario) {
    marcarSesionComoIniciada($arrayUsuario);
    redireccionar("ContenidoPrivado1.php");
} else {
    redireccionar("SesionInicioFormulario.php?datosErroneos");
}