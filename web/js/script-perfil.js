var propioUser=false;

var editando=false;
$(document).ready(function () {
    $('#foto').click(function () {
        if(editando){
            $('#imputFotoOculto').click();
        }

    });
});

var email = document.getElementById("mail").value;
var nombre = document.getElementById("nombre").value;
var tel = document.getElementById("tel").value;
var poblacion = document.getElementById("poblacion").value;
var rutaFoto = document.getElementById("foto").src;
var emailCorrecto = true;
var ponerImagen = document.getElementById("ponerImagen");

function editar() {
    let input_edita = document.getElementsByClassName("inputEdit");
    for (let i = 0; i < input_edita.length; i++) {
        input_edita[i].removeAttribute("disabled");
    }
    editando = true;
    document.getElementById("btn_edit").classList.add("nove");
    document.getElementById("btn_guarda").classList.remove("nove");
    if (document.getElementById("foto").src!="http://localhost/Polideportivo/web/imagenes/default.png") {
        document.getElementById("btn_quitarFoto").classList.remove("nove");
    }
    document.getElementById("btn_cancelar").classList.remove("nove");
    
    if (propioUser=="true") {
        document.getElementById("botonesEsp").classList.remove("nove");
        document.getElementById("botonesEsp").classList.add("siVeCajOpc");
    }
}

function cancelar() {
    let input_edita = document.getElementsByClassName("inputEdit");
    for (let i = 0; i < input_edita.length; i++) {
        input_edita[i].setAttribute("disabled", "true");
        input_edita[i].classList.add("a");
        input_edita[i].classList.remove("b");
    }
    
    if (propioUser=="true") {
        document.getElementById("botonesEsp").classList.remove("siVeCajOpc");
        document.getElementById("botonesEsp").classList.add("nove");
    }
    
    editando = false;
    document.getElementById("btn_edit").classList.remove("nove");
    document.getElementById("btn_guarda").classList.add("nove");
    document.getElementById("btn_cancelar").classList.add("nove");
    document.getElementById("btn_quitarFoto").classList.add("nove");

    document.getElementById("mail").value = email;
    document.getElementById("nombre").value = nombre;
    document.getElementById("tel").value = tel;
    document.getElementById("poblacion").value = poblacion;
    document.getElementById("foto").src = rutaFoto;
    
    borrarErrores();
    
    emailCorrecto = true;
    ponerImagen.value = "false";
    document.getElementById("errorFoto").innerHTML = "";
}

document.getElementById("imputFotoOculto").addEventListener("change", function () {
    if (this.files.length!=0) {
        const file = this.files[0];
        const fileType = file.type;
        document.getElementById("errorFoto").innerHTML = "";
        if (fileType != 'image/jpeg' && fileType != 'image/gif' && fileType != 'image/png' && fileType != 'image/webp') {
            document.getElementById("errorFoto").innerHTML = "El archivo no es una imagen";
            ponerImagen.value = "false";
        } else {
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            if (fileSizeMB > 10) {
                document.getElementById("errorFoto").innerHTML = "El archivo es superior a 10MB";
                ponerImagen.value = "false";
            }else{
                const imageUrl = URL.createObjectURL(file);
                ponerImagen.value = "true";
                document.getElementById("foto").src = imageUrl;
                if (document.getElementById("foto").src!="http://localhost/Polideportivo/web/imagenes/default.png") {
                    document.getElementById("btn_quitarFoto").classList.remove("nove");
                }else{
                    document.getElementById("btn_quitarFoto").classList.add("nove");
                }
            }
        }
    }
});

document.getElementById("btn_quitarFoto").addEventListener("click", function (){
    ponerImagen.value = "especial";
    document.getElementById("foto").src = "http://localhost/Polideportivo/web/imagenes/default.png";
    document.getElementById("btn_quitarFoto").classList.add("nove");
    document.getElementById("imputFotoOculto").value="";
});

function borrarErrores() {
    const elementos = document.querySelectorAll('strong');

    elementos.forEach(elemento => {
        elemento.remove();
    });
}


function validaFormulario(evento) {
    borrarErrores();
    var bien = true;

    var inputEmail = document.getElementById("mail");
    inputEmail.className = "inputEdit";
    inputEmail.classList.add("a");

    if (inputEmail.value != email) {
        if (!compruebaVacio(inputEmail) || !compruebaCaracteres(inputEmail, 100)) {
            bien = false;
        } else if (emailCorrecto == false) {
            bien = false;
            creaErrorPerfil(inputEmail, "repetido");
        }
    }

    var inputNombre = document.getElementById("nombre");
    inputNombre.className = "inputEdit";
    inputNombre.classList.add("a");

    if (inputNombre.value != nombre) {
        if (!compruebaVacio(inputNombre) || !compruebaCaracteres(inputNombre, 300)) {
            bien = false;
        }
    }

    var inputPoblacion = document.getElementById("poblacion");
    inputPoblacion.className = "inputEdit";
    inputPoblacion.classList.add("a");

    if (inputPoblacion.value != poblacion) {
        if (!compruebaVacio(inputPoblacion) || !compruebaCaracteres(inputPoblacion, 100)) {
            bien = false;
        }
    }


    var inputTelefono = document.getElementById("tel");
    inputTelefono.className = "inputEdit";
    inputTelefono.classList.add("a");

    if (inputTelefono.value != tel) {
        if (!compruebaVacio(inputTelefono) || !compruebaTelefono(inputTelefono, 9)) {
            bien = false;
        }
    }

    if (rutaFoto == document.getElementById("foto").src) {
        ponerImagen.value = "false";
    }

    if (bien) {
        return true;
    } else {
        evento.preventDefault();
        return false;
    }
}

function compruebaEmailPerfil() {
    var inputEmail = document.getElementById("mail");

    elementos = document.querySelectorAll('#pmail strong');
    if (elementos.length != 0) {
        elementos.forEach(elemento => {
            elemento.remove();
        });
        inputEmail.className = "inputEdit";
        inputEmail.classList.add("a");
    }

    if (inputEmail.value.trim().length == 0 || inputEmail.value == "") {
        inputEmail.className = "inputEdit";
        inputEmail.classList.add("a");
    } else {
        let data = new FormData();
        data.append("email", inputEmail.value);

        let url = "http://localhost/Polideportivo/index.php?action=comprobar_email&rapido=true";
        let init = {
            method: 'POST',
            body: data
        };
        fetch(url, init).then(function (respuesta) {
            return respuesta.json();
        }).then(function (json) {

            elementos = document.querySelectorAll('#pmail strong');
            if (elementos.length != 0) {
                elementos.forEach(elemento => {
                    elemento.remove();
                });
                inputEmail.className = "inputEdit";
                inputEmail.classList.add("a");
            }
            if (!json.existe) {
                emailCorrecto = true;
            } else {
                if (inputEmail.value != email) {
                    creaErrorPerfil(inputEmail, "repetido");
                    emailCorrecto = false;
                } else {
                    emailCorrecto = true;
                }
            }
        }).catch(function (error) {
            console.error(error);
        });
    }
}

function compruebaTelefono(input, num) {
    var valor = input.value;
    if (valor.length != num) {
        var mensaje = "Debe tener 9 numeros";
        creaErrorPerfil(input, mensaje);
        return false;
    } else {
        return true;
    }
}

function compruebaCaracteres(input, max) {
    var valor = input.value;
    if (valor.length > max) {
        var mensaje = "Maximo " + max + " caracteres";
        creaErrorPerfil(input, mensaje);
        return false;
    } else {
        return true;
    }
}

function compruebaVacio(input) {
    if (input.value.trim().length == 0 || input.value == "") {
        creaErrorPerfil(input, "Campo vacio");
        return false;
    } else {
        return true;
    }
}

function creaErrorPerfil(input, mensaje) {
    input.classList.remove("a");
    input.classList.add("b");
    var padre = input.parentNode;
    var busca = "#" + padre.id;
    var label = document.querySelector(busca);
    var labelText = label.childNodes[0];
    const strong = document.createElement('strong');
    strong.style.color = 'red';
    strong.style.fontSize = '14px';
    strong.textContent = mensaje;
    label.insertBefore(strong, labelText.nextSibling);
}



function darBaja() {
    document.getElementById("cajaOpcionesUser").className="siVeCajita";
    document.getElementById("FormBaja").className="siVeCajita";
}

function noBaja() {
    document.getElementById("cajaOpcionesUser").className="nove";
    document.getElementById("FormBaja").className="nove";
}

function siBaja() {
    var id = document.getElementById("idUserMod").value;
    location.href = "index.php?action=darseBaja&id=" + id;
}


function verCajaContra() {
    document.getElementById("cajaOpcionesUser").className="siVeCajita";
    document.getElementById("FormContra").className="siVeCajita";
    document.getElementById("errNuevaContra").innerHTML="";
}

function cambiarContra() {
    var bien=true;
    var contra1 = document.getElementById("nuevaContra").value;
    var contra2 = document.getElementById("nuevaContra2").value;
    if (contra1.trim().length == 0 || contra1 == "") {
        bien=false;
    }
    if (contra2.trim().length == 0 || contra2 == "") {
        bien=false;
    }
    if (bien) {
        if (contra1==contra2) {
            location.href = "index.php?action=cambiarContra&id=" + document.getElementById("idUserMod").value + "&contrase=" + contra1;
        }else{
            document.getElementById("errNuevaContra").innerHTML="Contraseñas diferentes";
            document.getElementById("nuevaContra").value="";
            document.getElementById("nuevaContra2").value="";
        }
    }else{
        document.getElementById("errNuevaContra").innerHTML="Contraseñas erroneas";
        document.getElementById("nuevaContra").value="";
        document.getElementById("nuevaContra2").value="";
    }
    
    
}


function quitarCajasUser(){
    document.getElementById("cajaOpcionesUser").className="nove";
    document.getElementById("FormBaja").className="nove";
    document.getElementById("FormContra").className="nove";
}

document.getElementById("mail").addEventListener("keyup", compruebaEmailPerfil, false);
document.getElementById("info").addEventListener("submit", validaFormulario, false);

document.getElementById("btn_cancelar").addEventListener("click", cancelar);
document.getElementById("btn_edit").addEventListener("click", editar);


propioUser=document.getElementById("banderaUser").value;

if (propioUser=="true") {
    document.getElementById("btn_cambiaContra").addEventListener("click", verCajaContra);
    document.getElementById("btn_darseBaja").addEventListener("click", darBaja);
    document.getElementById("btn_siDaBaja").addEventListener("click", siBaja);
    document.getElementById("btn_noDaBaja").addEventListener("click", noBaja);
    document.getElementById("xContraCamb").addEventListener("click", quitarCajasUser);
    document.getElementById("enlCambiaContra").addEventListener("click", cambiarContra);
}
