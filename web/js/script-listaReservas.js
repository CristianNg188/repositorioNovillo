function reiniciaFiltro() {
    document.getElementById("buscador").value = "";
    mostrarReservas();
    var input = document.getElementById("buscador");
    if (document.getElementById("filtro").value == "fechaReserva") {
        const newElement = input.cloneNode(true);
        input.replaceWith(newElement);
        newElement.setAttribute("type", "date");
        newElement.addEventListener("change", mostrarReservas);
    } else {
        const newElement = input.cloneNode(true);
        input.replaceWith(newElement);
        newElement.setAttribute("type", "text");
        newElement.addEventListener("keyup", mostrarReservas);
        mostrarReservas();
    }
}

function irCrearReserva() {
    location.href = "index.php?action=reservar";
}

function borrarReserva() {
    const url = "index.php?action=borrarReserva";
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
                }
            })
            .catch(error => console.error(error));
}

function mostrarReservas() {
    var inputBuscador = document.getElementById("buscador");
    var cadena = "" + inputBuscador.value;
    
    const url = "index.php?action=filtrarReservas";
    let data = new FormData();

    if (cadena.length === 0) {
        data.append("filtro", "todo");
        data.append("palabraClave", "a");
    } else {
        data.append("filtro", document.getElementById('filtro').value);
        data.append("palabraClave", cadena);
    }

    fetch(url, {
        method: "POST",
        body: data,
        credentials: 'same-origin'
    })
            .then(respuesta => respuesta.json())
            .then(json => {
                var reservas = json.reservas;
                limpiar();
                if (reservas[0] != -1) {
                    for (var i = 0; i < reservas.length; i++) {
                        document.getElementById(reservas[i]).removeAttribute("style");
                    }
                }
            })
            .catch(error => console.error(error));

}

function limpiar() {
    var filas = document.querySelectorAll(".userFiltro");
    for (var i = 0; i < filas.length; i++) {
        filas[i].style.display = "none";
    }
}

document.getElementById("buscador").addEventListener("keyup", mostrarReservas);
document.getElementById("filtro").addEventListener("change", reiniciaFiltro);
document.getElementById("btnCrearReserva").addEventListener("click", irCrearReserva);
var iconoBorra = document.querySelectorAll(".borrar");
for (var i = 0; i < iconoBorra.length; i++) {
    iconoBorra[i].addEventListener("click", borrarReserva);
}
var iconoDetalle = document.querySelectorAll(".verDetalle");
for (var i = 0; i < iconoDetalle.length; i++) {
    iconoDetalle[i].addEventListener("click",function (){
        var padre = this.parentNode;
        var abuelo = padre.parentNode;
        var id = abuelo.id;
        location.href = "index.php?action=listaLineas&idReserva="+id;
    });
}