for (let i = 1; i < 7; i++) {
    id="noti"+i;
    document.getElementById(id).addEventListener("click",redirige,false);
}
   
for (let i = 1; i < 4; i++) {
    id="opcion"+i;
    document.getElementById(id).addEventListener("click",function(){
        var ruta;
        switch (i) {
            case 1:
                ruta="index.php?action=reservar";
                break;
            case 2:
                ruta="index.php?action=actividades";
                break;
        
            default:
                ruta="index.php?action=actividades#anadidos";
                break;
        }
        window.location.href = ruta;
    },false);
}


function redirige() {
    var opcion=this.id;
    var num=opcion.substring(4);
    window.location.href = "index.php?action=noticias&focus="+num;
}