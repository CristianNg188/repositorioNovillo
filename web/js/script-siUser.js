function inicializar(){
    document.getElementById("sesionUser").addEventListener("click",verOpciones,false);
}

function verOpciones() {
    var lista=document.getElementById("opcionesUser");
    this.classList.toggle('efectoInicio');  
    lista.classList.toggle('aparece');            
}

window.onload=inicializar;