<?php
$colores = [
    "#FF0000" => "Rojo",
    "#00BFFF" => "Azul",
    "#32CD32" => "Verde",
    "#FFA500" => "Naranja",
    "#FFFF00" => "Amarillo",
    "#9932CC" => "Morado"
];
?>

<html lang="es-ES">
<head>
    <title>Colores</title>
    <meta charset="utf-8">
</head>
<body>
<label>
    <h2>Elige un color:</h2>
    <form action='parrafo.php' method='get'>
    <select name="colores">
        <?php
        foreach($colores as $codigo => $color){
            echo "<option value='$codigo'>$color</option>\n";
        }
        ?>
    </select>
        <input type="submit" value="Enviar">
</label>
</body>
</html>
