<?php

require_once "_com/DAO.php";

$contrasennaIncorrecta = isset($_REQUEST["contrasennaIncorrecta"]);
$usuarioNoValido = isset($_REQUEST["usuarioNoValido"]);
$fallo = isset($_REQUEST["fallo"]);
$identificador = isset($_REQUEST["identificador"]) ? $_REQUEST["identificador"] : "";
$nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
$apellidos = isset($_REQUEST["apellidos"]) ? $_REQUEST["apellidos"] : "";

?>

<html lang='es-ES'>

<head>
    <meta charset='UTF-8'>
    <title>Mini Facebook</title>
</head>

<body>

<h1>Registrarse</h1>

<?php if ($contrasennaIncorrecta) { ?>
    <p class='error'>La contraseña no coincide. <br>Intentelo de nuevo.</p>
<?php } ?>

<?php if ($usuarioNoValido) { ?>
    <p class='error'>Ese identificador no está disponible. <br>Intentelo de nuevo.</p>
<?php } ?>

<?php if ($usuarioNoValido) { ?>
    <p class='error'>Ha ocurrido un error.<br>Usuario no creado.</p>
<?php } ?>

<form method='post' action='UsuarioNuevoCrear.php'>

    <table>
        <tr>
            <td><strong>Nombre: </strong>
                <label>
                    <input type='text' name='nombre' id='nombre' value='<?= $nombre ?>'
                           placeholder="Introduce tu nombre."
                           required/>
                </label>
                <br><br>
                <strong>Apellidos: </strong>
                <label>
                    <input type='text' name='apellidos' id='apellidos' value='<?= $apellidos ?>'
                           placeholder="Introduce tus apellidos."
                           required/>
                </label>
                <br><br>
                <strong>Identificador: </strong>
                <label>
                    <input type='text' name='identificador' id='identificador' value='<?= $identificador ?>'
                           placeholder="Introduce tu identificador."
                           required/>
                </label>
                <br><br>
                <strong>Contraseña: </strong>
                <label>
                    <input type='password' name='contrasenna' id='identificador' placeholder="Introduce tu contraseña."
                           required/>
                </label>
                <br><br>
                <strong>Repite Contraseña: </strong>
                <label>
                    <input type='password' name='contrasenna2' id='identificador'
                           placeholder="Introduce de nuevo tu contraseña."
                           required/>
                </label>
            </td>
        </tr>
    </table>
    <br/>

    <button type='submit' name='registrarme' value='registrarme'>Registrarme</button>
    <p>Ya tengo cuenta: <a href='SesionInicioFormulario.php'>Iniciar Sesión.</a></p>
</form>
</body>
</html>