<?php

require_once "_com/DAO.php";

$arrayUsuarioNuevo = DAO::recogerDatosFormularioNuevoUsuario();

$identificador = $arrayUsuarioNuevo["identificador"];
$nombre = $arrayUsuarioNuevo["nombre"];
$apellidos = $arrayUsuarioNuevo["apellidos"];

if ($arrayUsuarioNuevo["contrasenna"] !== $arrayUsuarioNuevo["contrasenna2"]) {
    redireccionar("UsuarioNuevoFormulario.php?contrasennaIncorrecta&identificador=$identificador&nombre=$nombre&apellidos=$apellidos");

} else if (DAO::comprobarIdentificadorDisponible($arrayUsuarioNuevo["identificador"])) {

    if (DAO::crearUsuario($arrayUsuarioNuevo)) {
        redireccionar("SesionInicioFormulario.php?nuevo");
    }

} else {
    redireccionar("UsuarioNuevoFormulario.php?usuarioNoValido&identificador=$identificador&nombre=$nombre&apellidos=$apellidos");
}