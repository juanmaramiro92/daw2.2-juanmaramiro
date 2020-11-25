<?php
    if (!isset($_REQUEST["numero"]) || isset($_REQUEST["reset"])){
        $numero = 0;
    } else {
        $numero = $_REQUEST["numero"]+1;
    }
?>

<html lang="es-ES">
<head>
    <title>Suma de números</title>
    <meta charset='UTF-8'>
</head>
<body>
    <h2>Suma de números</h2>
    <form action='' method='get'>
        <input type='text' name='numero' value="<?=$numero?>" size="3" readonly />
        <input type='submit' name='suma' value="+1" />
        <input type="submit" name="reset" value="Reset" />
    </form>

</body>

</html>
