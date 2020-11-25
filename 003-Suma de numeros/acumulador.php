<?php

if (!isset($_REQUEST["acumulado"]) || isset($_REQUEST["reset"])){
    $acumulado = 0;
    $numero = 0;

} else if (isset($_REQUEST["suma"])){
    $acumulado = $_REQUEST["acumulado"] + $_REQUEST["numero"];
} else if (isset($_REQUEST["resta"])){
    $acumulado = $_REQUEST["acumulado"] - $_REQUEST["numero"];
}
?>

<html lang="es-ES">
<head>
    <title>Acumulador</title>
    <meta charset='UTF-8'>
</head>
<body>
<h2>Acumulador</h2>
<h2><?=$acumulado?></h2>

<form action='' method='get'>
    <input type='hidden' name='acumulado' value='<?=$acumulado?>' readonly />
    <input type="submit" name="resta" value="-" />
    <input type='text' name='numero' value="" size="3" />
    <input type='submit' name='suma' value="+" /><br>
    <input type="submit" name="reset" value="Reset" style="width: 110px" />
</form>

</body>

</html>
