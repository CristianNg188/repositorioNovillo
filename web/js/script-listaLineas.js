function borrarLinea() {
    const url = "index.php?action=borrarLinea";
    let data = new FormData();

    var padre = this.parentNode;
    var abuelo = padre.parentNode;
    var id = abuelo.id;
    data.append("id", id);

    fetch(url, {
        method: "POST",
        body: data,
        credentials: 'same-origin'
    })
            .then(respuesta => respuesta.json())
            .then(json => {
                if (json.resultado) {
                    abuelo.remove();
                    compruebaLineasRest();
                }
            })
            .catch(error => console.error(error));
}

function compruebaLineasRest(){
    var tabla=document.getElementById("tabla");
    if (tabla.rows.length==1) {
        location.href = "index.php?action=listarReservas";
    }
}

var iconoBorra = document.querySelectorAll(".borrar");
for (var i = 0; i < iconoBorra.length; i++) {
    iconoBorra[i].addEventListener("click", borrarLinea);
}