<?php

    $operando1 = (int)$_REQUEST['operando1'];
    $operacion = $_REQUEST['operacion'];
    $operando2 = (int)$_REQUEST['operando2'];

    if ($operacion == "+"){
        $resultado = $operando1 + $operando2;
    } else if ($operacion == "-") {
        $resultado = $operando1 - $operando2;
    } else if ($operacion == "x") {
        $resultado = $operando1 * $operando2;
    } else {
        if ($operando1 == 0 || $operando2 == 0) {
            $resultado = "La división por 0 no está definida";
        } else {
            $resultado = $operando1 / $operando2;
        }
    }

?>

<html lang="es-ES">
<head>
    <title>Resultado Calculadora</title>
    <meta charset="utf-8">
</head>
<body>
<h2><?=$operando1?> <?=$operacion?> <?=$operando2?> = <?=$resultado?></h2>
</body>
</html>
