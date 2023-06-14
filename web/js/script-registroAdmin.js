var comprobacionAjax = [false, false];

function compruebaEmail() {
    var inputEmail = document.getElementById("email");
    var email = inputEmail.value;
    var div = document.getElementById("divCorreo");

    elementos = document.querySelectorAll('#divCorreo label strong');
    if (elementos.length != 0) {
        elementos.forEach(elemento => {
            elemento.remove();
        });
        inputEmail.className = "a";
    }

    if (inputEmail.value.trim().length == 0 || inputEmail.value == "") {
        inputEmail.className = "a";
    }

    if (compruebaValor(email, div)) {

        var divHijo = obtenerDiv(div);

        quitarHijo(divHijo);
        crearCargando(divHijo);

        let data = new FormData();
        data.append("email", email);

        let url = "http://localhost/Polideportivo/index.php?action=comprobar_email";
        let init = {
            method: 'POST',
            body: data
        };
        fetch(url, init).then(function (respuesta) {
            return respuesta.json();
        }).then(function (json) {

            elementos = document.querySelectorAll('#divCorreo label strong');
            if (elementos.length != 0) {
                elementos.forEach(elemento => {
                    elemento.remove();
                });
                inputEmail.className = "a";
            }
            if (!json.existe) {
                if (!compruebaCaracteres(document.getElementById("email"), 100)) {
                    quitarHijo(divHijo);
                    crearError(divHijo);    
                    comprobacionAjax[0] = false;
                }else{
                    quitarHijo(divHijo);
                    crearBien(divHijo);
                    comprobacionAjax[0] = true;
                }
            } else {
                quitarHijo(divHijo);
                crearError(divHijo);
                creaError(inputEmail, "repetido");
                comprobacionAjax[0] = false;
            }
        }).catch(function (error) {
            console.error(error);
        });
    }
}

function compruebaDni() {
    var inputDni = document.getElementById("dni");
    var dni = inputDni.value;
    var div = document.getElementById("divDni");

    var elementos = document.querySelectorAll('#divDni label strong');
    if (elementos.length != 0) {
        elementos.forEach(elemento => {
            elemento.remove();
        });
        inputDni.className = "a";
    }

    if (compruebaValor(dni, div)) {

        var divHijo = obtenerDiv(div);

        quitarHijo(divHijo);
        crearCargando(divHijo);

        let data = new FormData();
        data.append("dni", dni);

        let url = "http://localhost/Polideportivo/index.php?action=comprobar_dni";
        let init = {
            method: 'POST',
            body: data
        };
        fetch(url, init).then(function (respuesta) {
            return respuesta.json();
        }).then(function (json) {

            elementos = document.querySelectorAll('#divDni label strong');
            if (elementos.length != 0) {
                elementos.forEach(elemento => {
                    elemento.remove();
                });
                inputDni.className = "a";
            }

            if (!json.existe) {
                if (compruebaFormatoDni(inputDni)) {
                    quitarHijo(divHijo);
                    crearBien(divHijo);
                    comprobacionAjax[1] = true;
                } else {
                    quitarHijo(divHijo);
                    crearError(divHijo);
                    comprobacionAjax[1] = false;
                }
            } else {
                creaError(inputDni, "repetido");
                quitarHijo(divHijo);
                crearError(divHijo);
                comprobacionAjax[1] = false;
            }
        }).catch(function (error) {
            console.error(error);
        });
    }
}

function validaFormulario(evento) {
    borrarErrores();
    var bien = true;

    var inputEmail = document.getElementById("email");
    inputEmail.className = "a";

    if (!compruebaVacio(inputEmail) || !compruebaCaracteres(inputEmail, 100)) {
        bien = false;
    } else if (comprobacionAjax[0] == false) {
        bien = false;
        creaError(inputEmail, "repetido");
    }

    var inputDni = document.getElementById("dni");
    inputDni.className = "a";

    if (!compruebaVacio(inputDni) || !compruebaFormatoDni(inputDni)) {
        bien = false;
    } else if (comprobacionAjax[1] == false) {
        bien = false;
        creaError(inputDni, "repetido");
    }

    var inputNombre = document.getElementById("nombre");
    inputNombre.className = "a";

    if (!compruebaVacio(inputNombre) || !compruebaCaracteres(inputNombre, 300)) {
        bien = false;
    }

    var inputPoblacion = document.getElementById("poblacion");
    inputPoblacion.className = "a";

    if (!compruebaVacio(inputPoblacion) || !compruebaCaracteres(inputPoblacion, 100)) {
        bien = false;
    }

    var inputTelefono = document.getElementById("telefono");
    inputTelefono.className = "a";

    if (!compruebaVacio(inputTelefono) || !compruebaTelefono(inputTelefono, 9)) {
        bien = false;
    }

    if (bien) {
        return true;
    } else {
        evento.preventDefault();
        return false;
    }

}

function borrarErrores() {
    const elementos = document.querySelectorAll('strong');

    elementos.forEach(elemento => {
        elemento.remove();
    });
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

function compruebaFormatoDni(input) {
    var dni = input.value;
    if (dni.length == 9) {
        var numeros = dni.substring(0, 8);
        if (isNaN(numeros)) {
            creaError(input, "formato incorrecto");
            return false;
        } else {
            var letra = dni.charCodeAt(8);
            if (letra > 64 && letra < 91) {
                return true;
            } else {
                creaError(input, "formato incorrecto");
                return false;
            }
        }
    } else {
        creaError(input, "necesita 9 caracteres");
        return false;
    }
}

function compruebaTelefono(input, num) {
    var valor = input.value;
    if (valor.length != num) {
        var mensaje = "Debe tener 9 numeros";
        creaError(input, mensaje);
        return false;
    } else {
        return true;
    }
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

function compruebaVacio(input) {
    if (input.value.trim().length == 0 || input.value == "") {
        creaError(input, "Campo vacio");
        return false;
    } else {
        return true;
    }
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

function quitarHijo(div) {
    var hijosDiv = div.children;
    if (hijosDiv.length != 0) {
        var segundoHijoDiv = hijosDiv[0];
        div.removeChild(segundoHijoDiv);
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

document.getElementById("email").addEventListener("keyup", compruebaEmail, false);
document.getElementById("dni").addEventListener("keyup", compruebaDni, false);
document.getElementById("formulario").addEventListener("submit", validaFormulario, false);