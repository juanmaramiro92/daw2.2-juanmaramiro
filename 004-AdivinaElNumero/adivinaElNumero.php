<?php

if (!isset($_REQUEST["intento"])) {
    $_REQUEST['oculto'] = $_REQUEST["numero"];
    $resultado = "¡Buena suerte!";
} else if ($_REQUEST["intento"] > $_REQUEST["oculto"]) {
    $resultado = "El número del Jugador 1 es más pequeño";
} else if ($_REQUEST["intento"] < $_REQUEST["oculto"]) {
    $resultado = "El número del Jugador 1 es más grande";
} else {
    $resultado = "¡Has acertado!";
}

if (isset($_REQUEST["numIntentos"])) {
    $numIntentos = (int)$_REQUEST["numIntentos"] + 1;
} else {
    $numIntentos = 0;
}

?>
<html lang="es-ES">
<head>
    <title>Adivina el número</title>
    <meta charset="utf-8">
</head>
<body>
<h3>Jugador 2: Introduce número</h3>
<form action="" method="POST">
    <input type="text" name="intento"/>
    <input type="hidden" name="oculto" value="<?=$_REQUEST['oculto']?>"/>
    <input type="hidden" name="numIntentos" value="<?=$numIntentos?>"/>
    <input type="submit" value="Enviar"/>
</form>
<p><?= $resultado ?></p>
<p>Nº de Intentos: <?=$numIntentos?></p>
<form action='introduceNumero.php' method='post'>
    <input type="submit" value="Reset"/>
</form>
</body>
</html>
