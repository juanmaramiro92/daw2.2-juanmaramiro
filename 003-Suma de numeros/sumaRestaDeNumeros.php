<?php
    if (!isset($_REQUEST["numero"]) || isset($_REQUEST["reset"])){
        $numero = 0;
    } else if (isset($_REQUEST["suma"])){
        $numero = $_REQUEST["numero"]+1;
    } else {
        $numero = $_REQUEST["numero"]-1;
    }
?>

<html lang="es-ES">
<head>
    <title>Suma y resta de números</title>
    <meta charset='UTF-8'>
</head>
<body>
<h2>Suma y resta de números</h2>
<form action='' method='get'>
    <input type="submit" name="resta" value="-1" />
    <input type='text' name='numero' value="<?=$numero?>" size="3" readonly />
    <input type='submit' name='suma' value="+1" /><br>
    <input type="submit" name="reset" value="Reset" style="width: 125px" />
</form>

</body>

</html>
