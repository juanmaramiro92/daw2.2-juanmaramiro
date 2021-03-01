<?php

require_once "_com/DAO.php";

$arrayUsuario = DAO::obtenerUsuarioPorContrasenna($_REQUEST["identificador"], $_REQUEST["contrasenna"]);

if ($arrayUsuario) {
    DAO::establecerSesionRam($arrayUsuario);

    if (isset($_REQUEST["recordar"])) DAO::establecerSesionCookie($arrayUsuario);

    redireccionar("MuroVerGlobal.php");
} else {
    redireccionar("SesionInicioFormulario.php?datosErroneos");
}