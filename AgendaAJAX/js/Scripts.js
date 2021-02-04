window.onload = inicializaciones;

function inicializaciones() {
    cargarTodasLasCategorias();
}

function cargarTodasLasCategorias() {
    // TODO v0.9 Obtener el JSON con UNA categoría.
    // TODO v1.0 Obtener el JSON con un ARRAY de categorías.

    // TODO Adaptar/traducir esto a Javascript/DOM/etc.
    // <?php foreach ($categorias as $categoria) { ?>
    //     <tr>
    // <td><a href='CategoriaFicha.php?id=<?=$categoria->getId()?>'>    <?=$categoria->getNombre()?> </a></td>
    // <td><a href='CategoriaEliminar.php?id=<?=$categoria->getId()?>'> (X)                            </a></td>
    // </tr>
    // <?php } ?>

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            cargarXml(this.response);
        }
    };

    request.open("GET", "CategoriaObtenerTodas.php", true);
    request.send();
}

function cargarXml(xml) {
    var datos = document.getElementById("datos");

    var objeto = JSON.parse(xml);

    document.getElementById("datos").innerHTML = objeto.nombre;

}