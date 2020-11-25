<html lang="es-ES">

<head>
    <title>Calculadora</title>
    <meta charset='UTF-8'>
</head>

<body>

<form action='calculadoraResultado.php' method='post'>
    <input type='text' name='operando1' style="width: 60px"/>
    <select name="operacion">
        <option>+</option>
        <option>-</option>
        <option>x</option>
        <option>:</option>
    </select>
    <input type='text' name='operando2' style="width: 60px"/><br>
    <input type='submit' name='boton' value="Calcular" style="width: 160px"/>
</form>

</body>

</html>
