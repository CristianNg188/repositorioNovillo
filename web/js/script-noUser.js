function inicializar(){
    document.getElementById("inicioSesion").addEventListener("click",verSesion,false);
    document.getElementById("x").addEventListener("click",cambiaSesion,false);
}

function verSesion() {
    var div=document.getElementById("cajaSesion");
    div.classList.remove("nove");
    div.classList.add("ve");
}

function cambiaSesion() {
    if (document.getElementById("errorInicioSesion")!=null) {
        document.getElementById("errorInicioSesion").style.display = "none";
    }    
    var div=document.getElementById("cajaSesion");
    div.classList.remove("ve");
    div.classList.add("nove");
}

window.onload=inicializar;