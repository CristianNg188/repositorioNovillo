var enviar = false;
var existe = true;

function compruebaEmailExiste() {
    var inputEmail = document.getElementById("email");
    document.getElementById("btn").setAttribute("disabled", "true");
    var email = inputEmail.value;
    if (email.trim().length != 0) {
        var div = document.getElementById("muestra_valido");
        quitarHijo(div);
        crearCargando(div);

        let data = new FormData();
        data.append("email", email);

        let url = "http://localhost/Polideportivo/index.php?action=comprobar_emailExiste";
        let init = {
            method: 'POST',
            body: data
        };
        fetch(url, init).then(function (respuesta) {
            return respuesta.json();
        }).then(function (json) {
            quitarHijo(div);
            if (!json.existe) {
                crearError(div);
                document.getElementById("btn").setAttribute("disabled", "true");
            } else {
                crearBien(div);
                document.getElementById("btn").removeAttribute("disabled");
                document.getElementById("correo").value = email;
            }
        }).catch(function (error) {
            console.error(error);
        });
    }
}

function compruebaUsuarioExiste() {
    var inputUsuario = document.getElementById("usuario");
    var usuario = inputUsuario.value;
    existe = true;

    var elementos = document.querySelectorAll('#divUser strong');
    if (elementos.length != 0) {
        elementos.forEach(elemento => {
            elemento.remove();
        });
    }
    var divUser = document.getElementById("divUser");
    quitarHijoUser(divUser);
    inputUsuario.className = "a2";
    if (usuario.trim().length != 0) {

        var div = document.getElementById("muestra_valido2");
        crearCargando(div);

        let data = new FormData();
        data.append("user", usuario);

        let url = "http://localhost/Polideportivo/index.php?action=comprobar_usuarioExiste";
        let init = {
            method: 'POST',
            body: data
        };
        fetch(url, init).then(function (respuesta) {
            return respuesta.json();
        }).then(function (json) {
            quitarHijo(div);
            if (!json.existe) {
                crearBien(div);
                inputUsuario.className = "a2";
                existe = false;
            } else {
                crearError(div);
                inputUsuario.className = "b";
                existe = true;
            }
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
        div.removeChild(div.firstChild);
    }
}

function quitarHijoUser(div) {
    var hijosDiv = div.children;
    if (hijosDiv.length != 0) {
        div.removeChild(div.lastChild);
    }
    var divNuevo = document.createElement("div");
    divNuevo.setAttribute("id", "muestra_valido2");
    div.appendChild(divNuevo);
}

function validar(evento) {
    if (enviar) {
        var bien = true;
        borrarErrores();
        var inputUsuario = document.getElementById("usuario");
        inputUsuario.className = "a2";
        var div = document.getElementById("divUser");
        if (!compruebaVacio(inputUsuario, div) || !compruebaCaracteres(inputUsuario, div, 20)) {
            bien = false;
        } else if (existe) {
            creaError(inputUsuario, div, "usuario existente");
            bien = false;
        }

        var inputContra = document.getElementById("contra");
        inputContra.className = "a2";
        var divContra = document.getElementById("divContra");
        var inputContra2 = document.getElementById("contra2");
        inputContra2.className = "a2";
        var divContra2 = document.getElementById("divContra2");
        if (!compruebaVacio(inputContra, divContra)) {
            bien = false;
            inputContra2.value = "";
        } else {
            if (!compruebaVacio(inputContra2, divContra2)) {
                bien = false;
            }
        }

        if (!compruebaCaracteres(inputContra, divContra, 50)) {
            bien = false;
            inputContra2.value = "";
        }
        if (bien) {
            if (!compruebaContra(inputContra, inputContra2, divContra)) {
                bien = false;
                inputContra2.value = "";
            }
        }

        if (bien) {
            return true;
        } else {
            evento.preventDefault();
            return false;
        }
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

function compruebaContra(input1, input2, div) {
    var contra1 = input1.value;
    var contra2 = input2.value;
    if (contra1 != contra2) {
        creaError(input1, div, "contraseñas diferentes");
        return false
    } else {
        return true;
    }
}

function compruebaCaracteres(input, div, max) {
    var valor = input.value;
    if (valor.length > max) {
        var mensaje = "Maximo " + max + " caracteres";
        creaError(input, div, mensaje);
        return false;
    } else {
        return true;
    }
}

function compruebaVacio(input, div) {
    if (input.value.trim().length == 0 || input.value == "") {
        creaError(input, div, "Campo vacio");
        return false;
    } else {
        return true;
    }
}

function creaError(input, div, mensaje) {
    input.className = "b";
    var hijosDiv = div.children;
    if (hijosDiv.length != 0) {
        div.removeChild(div.lastChild);
    }
    var text = div.childNodes[0];
    const strong = document.createElement('strong');
    strong.style.color = 'red';
    strong.style.fontSize = '13px';
    strong.textContent = mensaje;
    div.insertBefore(strong, text.nextSibling);
}

function delante() {
    var caja = document.getElementById("email1");
    caja.classList.add("desaparece");
    caja.classList.remove("aparece");
    var caja2 = document.getElementById("email2");
    caja2.classList.remove("desaparece");
    caja2.classList.add("aparece");
    enviar = true;
}

function atras() {
    var caja = document.getElementById("email2");
    caja.classList.add("desaparece");
    caja.classList.remove("aparece");
    var caja2 = document.getElementById("email1");
    caja2.classList.remove("desaparece");
    caja2.classList.add("aparece");
    enviar = false;
}

document.getElementById("email").addEventListener("keyup", compruebaEmailExiste, false);
document.getElementById("usuario").addEventListener("keyup", compruebaUsuarioExiste, false);
document.getElementById("email2").addEventListener("submit", validar, false);
document.getElementById("btnAtrasRegisUs").addEventListener("click", atras, false);
document.getElementById("btn").addEventListener("click", delante, false);