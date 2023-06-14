function reiniciaFiltro() {
    document.getElementById("buscador").value = "";
    mostrarPistas();
}

function irCrearPista() {
    location.href = "index.php?action=crearPistas";
}

function editarPista() {
    var padre = this.parentNode;
    var abuelo = padre.parentNode;
    var id = abuelo.id;
    location.href = "index.php?action=crearPistas&id=" + id;
}

function borrarPista() {
    const url = "index.php?action=borrarPista";
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

function mostrarPistas() {
    var inputBuscador = document.getElementById("buscador");
    var cadena = inputBuscador.value;

    const url = "index.php?action=filtrarPistas";
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
                var pistas = json.pistas;
                limpiar();
                if (pistas[0] != -1) {
                    for (var i = 0; i < pistas.length; i++) {
                        document.getElementById(pistas[i]).removeAttribute("style");
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

document.getElementById("buscador").addEventListener("keyup", mostrarPistas);
document.getElementById("filtro").addEventListener("change", reiniciaFiltro);
document.getElementById("btnCrearPista").addEventListener("click", irCrearPista);
var iconoBorra = document.querySelectorAll(".borrar");
for (var i = 0; i < iconoBorra.length; i++) {
    iconoBorra[i].addEventListener("click", borrarPista);
}

var iconoEdita = document.querySelectorAll(".editar");
for (var q = 0; q < iconoEdita.length; q++) {
    iconoEdita[q].addEventListener("click", editarPista);
}