var array = [];

function mostrar() {
    var fecha = document.getElementById("calendario").value;
    if(fecha==null || fecha==""){
        var fechaActual = new Date();
        fechaActual.setDate(fechaActual.getDate() + 1);
        var año = fechaActual.getFullYear();
        var mes = (fechaActual.getMonth() + 1).toString().padStart(2, '0'); 
        var dia = fechaActual.getDate().toString().padStart(2, '0');

        fecha = año+"-"+mes+"-"+dia;
    }
    location.href = "index.php?action=reservar&fecha=" + fecha;
}

function reservar(e) {
    if (!e)
        e = window.event;
    
    var id = e.target.id;
    var celda = document.getElementById(id);

    if (celda.className == "libre") {
        celda.className = "posible";
        array.push(id);
    } else if (celda.className == "posible") {
        celda.className = "libre";
        for (var i = 0; i < array.length; i++) {
            var comp = array[i];
            if (comp == id) {
                array.splice(i, 1);
            }
        }

    }

}

function enviar() {
    if (array.length != 0) {
        var fecha = document.getElementById("calendario").value;
        var numArray=array.length;
        location.href = "index.php?action=confirmarReserva&infoReservas=" + array + "&fecha=" + fecha+"&numArray="+numArray;
    } else {
        alert("Deber reservar antes");
    }

}

var elementosLibres = document.getElementsByClassName("libre");

for (var i = 0; i < elementosLibres.length; i++) {
    elementosLibres[i].addEventListener('click', reservar);
}

document.getElementById("calendario").addEventListener("change", mostrar, false);
document.getElementById("btnConfirmaReserva").addEventListener("click", enviar, false);