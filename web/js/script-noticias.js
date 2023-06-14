var numNoticias = 0;
var numSituacion = 1;
var paginas = 0;
var infoNotiErr = document.getElementById("infoNotiErr");

function paginacion() {

    var articles = document.querySelectorAll("article");
    numNoticias = articles.length;
    paginas = Math.ceil(numNoticias / 4);

    for (let i = 0; i < articles.length; i++) {

        var article = articles[i];
        article.id = i + 1;

        if (Math.ceil(article.id / 4) > 1) {
            article.className = "nove";
        }

    }

    creaPaginacion();

    var numNuevo = document.querySelectorAll(".num1");
    for (let y = 0; y < 2; y++) {
        var numPag = numNuevo[y];
        numPag.classList.add("subrayado");
    }

    crearIndice(articles);

}

function creaPaginacion() {

    var flechasDerecha = document.querySelectorAll(".btn-der");
    for (let i = 0; i < 2; i++) {
        var flecha = flechasDerecha[i];
        flecha.addEventListener("click", siguiente);
        flecha.classList.add("punteroRaton");
    }

    var flechasIzquierda = document.querySelectorAll(".btn-izq");
    for (let j = 0; j < 2; j++) {
        var flecha = flechasIzquierda[j];
        flecha.addEventListener("click", atras);
        flecha.classList.add("punteroRaton");
    }

    var paginaciones = document.querySelectorAll(".paginacion");
    for (let k = 0; k < paginaciones.length; k++) {

        var paginacionEdit = paginaciones[k];
        var posi = 1;

        for (let l = 1; l <= paginas; l++) {

            var p = document.createElement("p");
            var nuevoTexto = document.createTextNode(l);
            p.appendChild(nuevoTexto);
            p.classList.add("punteroRaton");
            p.classList.add("num" + l);

            p.addEventListener("click", function () {
                var texto = Number(this.textContent);
                cambiarPagina(numSituacion, texto);
            });


            paginacionEdit.insertBefore(p, paginacionEdit.children[posi]);
            posi++;

            if ((l + 1) <= paginas) {
                var guion = document.createElement("p");
                var textoOtra = document.createTextNode("-");
                guion.appendChild(textoOtra);

                paginacionEdit.insertBefore(guion, paginacionEdit.children[posi]);
                posi++;
            }

        }

    }
}

function crearIndice(articles) {

    var lista = document.getElementById("lista");

    for (let i = 0; i < articles.length; i++) {

        var article = articles[i];
        var li = document.createElement("li");
        var a = document.createElement("a");

        var hElement = article.getElementsByClassName("titular")[0].getElementsByTagName("h1")[0];
        var titulo = hElement.textContent;
        var nuevoTexto = document.createTextNode(titulo);

        a.appendChild(nuevoTexto);
        a.classList.add("punteroRaton", "subrayado");
        a.setAttribute("id", "a" + (i + 1));
        a.addEventListener("click", function () {
            var id = this.id;
            var num = id.substring(1);
            var articles = document.querySelectorAll("article");
            for (let i = 0; i < articles.length; i++) {
                var article = articles[i];
                if (article.id == num) {
                    cambiarPagina(numSituacion, Math.ceil(article.id / 4));
                    article.scrollIntoView({ behavior: 'smooth' });
                }
            }
        }, false);
        li.appendChild(a);
        lista.appendChild(li);

    }

}

function siguiente() {
    if (numSituacion != paginas) {
        var pagAntigua = numSituacion;
        numSituacion++;
        cambiarPagina(pagAntigua, numSituacion);
    }
}

function atras() {
    if (numSituacion != 1) {
        var pagAntigua = numSituacion;
        numSituacion--;
        cambiarPagina(pagAntigua, numSituacion);
    }
}

function cambiarPagina(numPaginaAntigua, numPaginaNueva) {
    infoNotiErr.className = "nove";
    var num = document.querySelectorAll(".num" + numPaginaAntigua);
    for (let x = 0; x < 2; x++) {
        var numPag = num[x];
        numPag.classList.remove("subrayado");
    }

    var numNuevo = document.querySelectorAll(".num" + numPaginaNueva);
    for (let y = 0; y < 2; y++) {
        var numPag = numNuevo[y];
        numPag.classList.add("subrayado");
    }

    var articles = document.querySelectorAll("article");
    for (let i = 0; i < articles.length; i++) {
        var article = articles[i];
        if (Math.ceil(article.id / 4) == numPaginaNueva) {
            article.className = "";
        } else {
            article.className = "nove";
        }
    }
    document.getElementById("fecha").value="";
    numSituacion = numPaginaNueva;
    scrollToTop();
}

function filtrarPorFecha() {
    infoNotiErr.className = "nove";
    var fecha = document.getElementById("fecha").value;
    var existe = false;
    if (fecha == "") {
        cambiarPagina(numSituacion, numSituacion);
        existe = true;
    } else {
        var articles = document.querySelectorAll("article");
        for (let i = 0; i < articles.length; i++) {
            var article = articles[i];
            var pElement = article.getElementsByClassName("titular")[0].getElementsByTagName("p")[0];
            var fechaArticle = pElement.textContent;
            if (fechaArticle == fecha) {
                article.className = "";
                numSituacion = Math.ceil(article.id / 4);
                existe = true;
            } else {
                article.className = "nove";
            }
            var num = document.querySelectorAll(".num" + numSituacion);
            for (let x = 0; x < 2; x++) {
                var numPag = num[x];
                numPag.classList.remove("subrayado");
            }
        }
    }

    if (!existe) {
        infoNotiErr.className = "";
    }

}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}

document.getElementById("fecha").addEventListener("change", filtrarPorFecha, false);
paginacion();

if (document.getElementById("noticiaFocus").value!="no") {
    var idFocuseado=document.getElementById("noticiaFocus").value;
    var articuloFocus=document.getElementById(idFocuseado);
    if (articuloFocus!=null) {
        cambiarPagina(numSituacion, Math.ceil(articuloFocus.id / 4));
        articuloFocus.scrollIntoView({ behavior: 'smooth' });
    }
}
