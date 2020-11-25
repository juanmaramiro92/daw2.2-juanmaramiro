<?php
    if (!isset($_REQUEST["ciudad"])) $ciudad = false;
    else $ciudad = $_REQUEST["ciudad"];
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php
    if (!$ciudad) {
?>

    <p>¿Cuál es tu cuidad favorita?</p>
    <form method='get'>
        <input type='text' name='ciudad' />
        <input type='submit' name='boton' value="Enviar" />
    </form>

<?php
    } else {
?>

    <p>Tu ciudad favorita es <?=$ciudad?>.</p>
    <a href='https://www.google.com/search?q=<?=$ciudad?>'>Buscar información sobre <?=$ciudad?></a>

<?php
    }
?>

</body>

</html>