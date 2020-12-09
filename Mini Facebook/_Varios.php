<?php

declare(strict_types=1);

session_start();

function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $bd = "MiniFb";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage());
        exit('Error al conectar');
    }

    return $conexion;
}

function obtenerUsuario(string $identificador, string $contrasenna): ?array
{
    $pdo = obtenerPdoConexionBD();

    $sql = "SELECT * FROM Usuario WHERE identificador=? AND BINARY contrasenna=?";
    $select = $pdo->prepare($sql);
    $select->execute([$identificador, $contrasenna]);
    $rs = $select->fetchAll();

    return $select->rowCount()==1 ? $rs[0] : null;
}

function marcarSesionComoIniciada(array $arrayUsuario)
{
    $_SESSION["id"] = $arrayUsuario["id"];
    $_SESSION["identificador"] = $arrayUsuario["identificador"];
    $_SESSION["tipoUsuario"] = $arrayUsuario["tipoUsuario"];
    $_SESSION["nombre"] = $arrayUsuario["nombre"];
    $_SESSION["apellidos"] = $arrayUsuario["apellidos"];
}

function haySesionIniciada(): bool
{
    return isset($_SESSION["id"]);
}

function pintarInfoSesion() {
    if (haySesionIniciada()) {
        echo "<span>Sesión iniciada por <a href='UsuarioPerfilVer.php'>$_SESSION[identificador]</a> ($_SESSION[nombre] $_SESSION[apellidos]) <a href='SesionCerrar.php'>Cerrar sesión</a></span>";
    } else {
        echo "<a href='SesionInicioFormulario.php'>Iniciar sesión</a>";
    }
}

function cerrarSesionRamYCookie()
{
    session_destroy();
    unset($_SESSION);
}

function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}