var numeroCorrecto = false;

function compruebaVacioTipo() {
    var valor = document.getElementById("tipo").value;
    if (valor.trim().length == 0 || valor == "") {
        document.getElementById("numero").setAttribute("disabled", "true");
        document.getElementById("numero").value = "";
        compruebaNumeroExiste();
    } else {
        document.getElementById("numero").removeAttribute("disabled");
        compruebaNumeroExiste();
    }
}

function cambiaTipo() {
    var selectTipo = document.getElementById("selectTipo");
    var valorSelect = selectTipo.value;

    var inputTipo = document.getElementById("tipo");
    inputTipo.value = valorSelect;
    compruebaVacioTipo();
}

function validaFormulario(evento) {
    borrarErrores();
    var bien = true;

    var inputTipo = document.getElementById("tipo");
    inputTipo.className = "a";

    if (!compruebaVacio(inputTipo) || !compruebaCaracteres(inputTipo, 30)) {
        bien = false;
    }

    var inputNumero = document.getElementById("numero");
    inputNumero.className = "a";

    var verificador = document.getElementById("numVerifica").value;
    var verificadorTipo = document.getElementById("tipoVerifica").value;
    if (verificador != -1 && verificador == inputNumero.value && verificadorTipo.toLowerCase() == inputTipo.value.toLowerCase()) {
        numeroCorrecto = true;
    }

    if (!compruebaVacio(inputNumero) || !compruebaNumero(inputNumero, 100) || !compruebaNumeroCorrecto(inputNumero)) {
        bien = false;
    }

    var inputDescripcion = document.getElementById("descripcion");
    inputDescripcion.className = "a";

    if (!compruebaVacio(inputDescripcion) || !compruebaCaracteres(inputDescripcion, 250)) {
        bien = false;
    }

    var inputPrecio = document.getElementById("precio");
    inputPrecio.className = "a";

    if (!compruebaVacio(inputPrecio) || !compruebaNumero(inputPrecio, 100)) {
        bien = false;
    }

    if (bien) {
        return true;
    } else {
        evento.preventDefault();
        return false;
    }

}

function compruebaNumeroCorrecto(input) {
    if (numeroCorrecto == false) {
        creaError(input, "repetido");
        return false;
    } else {
        return true;
    }
}

function compruebaNumeroExiste() {
    var input = document.getElementById("numero");
    var num = input.value;
    var div = document.getElementById("divNumero");

    elementos = document.querySelectorAll('#divNumero label strong');
    if (elementos.length != 0) {
        elementos.forEach(elemento => {
            elemento.remove();
        });
        input.className = "a";
    }

    if (input.value.trim().length == 0 || input.value == "") {
        input.className = "a";
    }

    if (compruebaValor(num, div)) {

        var divHijo = obtenerDiv(div);

        quitarHijo(divHijo);
        crearCargando(divHijo);

        let data = new FormData();
        data.append("numero", num);
        data.append("tipo", document.getElementById("tipo").value);
        let url = "http://localhost/Polideportivo/index.php?action=compruebaNumeroExiste";
        let init = {
            method: 'POST',
            body: data
        };
        fetch(url, init).then(function (respuesta) {
            return respuesta.json();
        }).then(function (json) {

            elementos = document.querySelectorAll('#divNumero label strong');
            if (elementos.length != 0) {
                elementos.forEach(elemento => {
                    elemento.remove();
                });
                input.className = "a";
            }
            if (!json.existe) {
                quitarHijo(divHijo);
                crearBien(divHijo);
                numeroCorrecto = true;
            } else {
                var inputTipo = document.getElementById("tipo");
                var inputNumero = document.getElementById("numero");
                var verificadorTipo = document.getElementById("tipoVerifica").value;
                var verificador = document.getElementById("numVerifica").value;
                if (verificador != -1 && verificador == inputNumero.value && verificadorTipo.toLowerCase() == inputTipo.value.toLowerCase()) {
                    quitarHijo(divHijo);
                    crearBien(divHijo);
                    numeroCorrecto = true;
                } else {
                    quitarHijo(divHijo);
                    crearError(divHijo);
                    creaError(input, "repetido");
                    numeroCorrecto = false;
                }

            }
            input.classList.add("numero");
        }).catch(function (error) {
            console.error(error);
        });
    }
}

function crearCargando(divHijo) {

    var divspiner = document.createElement("div");
    divspiner.classList.add("spinner-border", "spinner");
    divspiner.setAttribute("role", "status");

    var span = document.createElement("span");
    span.classList.add("visually-hidden");

    divspiner.appendChild(span);
    divHijo.appendChild(divspiner);
}

function crearBien(divHijo) {
    var iCheck = document.createElement("i");
    iCheck.classList.add("fa-solid", "fa-check", "email-check");
    divHijo.appendChild(iCheck);
}

function crearError(divHijo) {
    var iError = document.createElement("i");
    iError.classList.add("fa-solid", "fa-xmark", "email-error");
    divHijo.appendChild(iError);
}

function quitarHijo(div) {
    var hijosDiv = div.children;
    if (hijosDiv.length != 0) {
        var segundoHijoDiv = hijosDiv[0];
        div.removeChild(segundoHijoDiv);
    }
}

function obtenerDiv(div) {
    var hijosDiv = div.children;
    var segundoHijoDiv = null;

    if (hijosDiv.length == 1) {
        segundoHijoDiv = document.createElement("div");
        segundoHijoDiv.classList.add("linea");
        div.appendChild(segundoHijoDiv);
    } else {
        segundoHijoDiv = hijosDiv[1];
    }
    return segundoHijoDiv;
}

function compruebaValor(valor, div) {
    if (valor == "" || valor.trim().length == 0) {
        var hijosDiv = div.children;

        if (hijosDiv.length != 1) {
            var segundoHijoDiv = hijosDiv[1];
            div.removeChild(segundoHijoDiv);
        }

        return false;
    } else {
        return true;
    }
}

function borrarErrores() {
    const elementos = document.querySelectorAll('strong');

    elementos.forEach(elemento => {
        elemento.remove();
    });
}

function compruebaCaracteres(input, max) {
    var valor = input.value;
    if (valor.length > max) {
        var mensaje = "Maximo " + max + " caracteres";
        creaError(input, mensaje);
        return false;
    } else {
        return true;
    }
}

function compruebaNumero(input, max) {
    var valor = input.value;
    if (valor > max) {
        var mensaje = "Maximo " + max + " numeros válidos";
        creaError(input, mensaje);
        return false;
    } else {
        return true;
    }
}

function compruebaVacio(input) {
    if (input.value.trim().length == 0 || input.value == "") {
        creaError(input, "Campo vacio");
        return false;
    } else {
        return true;
    }
}

function creaError(input, mensaje) {
    input.classList.remove("a");
    input.classList.add("b");
    var padre = input.parentNode;
    var abuelo = padre.parentNode;
    var busca = "#" + abuelo.id + " label";
    var label = document.querySelector(busca);
    var labelText = label.childNodes[0];
    const strong = document.createElement('strong');
    strong.style.color = 'red';
    strong.style.fontSize = '15px';
    strong.textContent = mensaje;
    label.insertBefore(strong, labelText.nextSibling);
}

document.getElementById("selectTipo").addEventListener("change", cambiaTipo);
document.getElementById("formulario").addEventListener("submit", validaFormulario);
document.getElementById("tipo").addEventListener("keyup", compruebaVacioTipo);
document.getElementById("numero").addEventListener("keyup", compruebaNumeroExiste);