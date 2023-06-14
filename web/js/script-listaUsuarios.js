function reiniciaFiltro() {
    document.getElementById("buscador").value = "";
    mostrarUsuarios();
}

function selectUsuario() {
    const url = "index.php?action=cambiarAtributoUsuario";
    let data = new FormData();

    var name = this.name;
    var padre = this.parentNode;
    var abuelo = padre.parentNode;
    var id = abuelo.id;

    data.append("id", id);
    data.append("name", name);

    fetch(url, {
        method: "POST",
        body: data,
        credentials: 'same-origin'
    })
            .then(respuesta => respuesta.json())
            .then(json => {

            })
            .catch(error => console.error(error));
}

function editarUsuario() {
    var padre = this.parentNode;
    var abuelo = padre.parentNode;
    var id = abuelo.id;
    location.href = "index.php?action=PerfilUsuario&id=" + id +"&pagina=listarUsuarios";
}

function borrarUsuario() {
    const url = "index.php?action=borrarUsuario";
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

function mostrarUsuarios() {
    var inputBuscador = document.getElementById("buscador");
    var cadena = inputBuscador.value;

    const url = "index.php?action=filtrarUsuarios";
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
                var usuarios = json.usuarios;
                limpiar();
                if (usuarios[0] != -1) {
                    for (var i = 0; i < usuarios.length; i++) {
                        document.getElementById(usuarios[i]).removeAttribute("style");
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

document.getElementById("buscador").addEventListener("keyup", mostrarUsuarios);
document.getElementById("filtro").addEventListener("change", reiniciaFiltro);

var iconoBorra = document.querySelectorAll(".borrar");
for (var i = 0; i < iconoBorra.length; i++) {
    iconoBorra[i].addEventListener("click", borrarUsuario);
}

var iconoEdita = document.querySelectorAll(".editar");
for (var q = 0; q < iconoEdita.length; q++) {
    iconoEdita[q].addEventListener("click", editarUsuario);
}

var select = document.querySelectorAll(".select");
for (var j = 0; j < select.length; j++) {
    select[j].addEventListener("change", selectUsuario);
}

document.getElementById("btnRegistrarUsuario").addEventListener("click", function(){
    location.href = "index.php?action=registroAdmin";
});
