var identificador = 1;
var jugadorElegido = null;
var ids = [];

var cajaErrAnadir = document.getElementById("errAnadir");
var cajaErrBorrar = document.getElementById("errBorrar");
var cajaErrSortear = document.getElementById("errSortear");

function anadir() {

    var jugador = document.getElementById("jugador").value.trim();

    cajaErrAnadir.innerHTML = "";

    if (jugador.length != 0) {
        if (ids.length == 22) {
            cajaErrAnadir.innerHTML = "Máximo de jugadores alcanzado";
        } else {
            var cajaMaestra = document.getElementById("cajaJugadores");

            cajaErrBorrar.innerHTML = "";
            cajaErrSortear.innerHTML = "";

            var cajaJugador = document.createElement("p");
            var texto = document.createTextNode(jugador);
            cajaJugador.id = identificador;
            ids.push(identificador);
            identificador++;

            cajaJugador.addEventListener("click", function () {
                
                cajaErrAnadir.innerHTML = "";
                cajaErrSortear.innerHTML = "";
                cajaErrBorrar.innerHTML = "";
                this.classList.toggle("elegidoListaSub");

                if (this.className == "") {
                    jugadorElegido = null;
                } else {
                    if (jugadorElegido != null) {
                        var jugadorViejo = document.getElementById(jugadorElegido);
                        jugadorViejo.classList.toggle("elegidoListaSub");
                    }
                    jugadorElegido = this.id;
                }
            });

            cajaJugador.appendChild(texto);
            cajaMaestra.appendChild(cajaJugador);

            document.getElementById("jugador").value = "";
            
            var jugadorViejo = document.getElementById(jugadorElegido);
            if (jugadorViejo!=null) {
                jugadorViejo.classList.toggle("elegidoListaSub");
            }
            
            jugadorElegido = null;
        }
    } else {
        cajaErrAnadir.innerHTML = "Campo vacío";
    }
}

function borrar() {
    cajaErrBorrar.innerHTML = "";

    if (jugadorElegido == null) {
        cajaErrBorrar.innerHTML = "Ningún elemento seleccionado";
    } else {
        var cajaMaestra = document.getElementById("cajaJugadores");

        for (let i = 0; i < cajaMaestra.childNodes.length; i++) {

            var jugador = cajaMaestra.childNodes[i];
            if (jugador.id == jugadorElegido) {

                cajaMaestra.removeChild(jugador);
                i = cajaMaestra.childNodes.length;

                for (let j = 0; j < ids.length; j++) {

                    if (jugadorElegido == ids[j]) {
                        ids.splice(j, 1);
                    }
                }

                jugadorElegido = null;
            }
        }
        cajaErrAnadir.innerHTML = "";
        cajaErrSortear.innerHTML = "";
    }
}

function sortear() {
    cajaErrSortear.innerHTML = "";

    if (ids.length == 0) {
        cajaErrSortear.innerHTML = "No hay jugadores";
    } else {

        var equipo1 = document.getElementById("listaEquipo1");
        var equipo2 = document.getElementById("listaEquipo2");

        while (equipo1.firstChild) {
            equipo1.removeChild(equipo1.firstChild);
        }

        while (equipo2.firstChild) {
            equipo2.removeChild(equipo2.firstChild);
        }

        var tope = Math.floor(ids.length / 2);
        var borrador = [];

        for (let x = 0; x < ids.length; x++) {
            borrador.push(ids[x]);
        }

        while (borrador.length != 0) {

            var indiceAleatorio = Math.floor(Math.random() * borrador.length);
            var numAleatorio = borrador[indiceAleatorio];
            borrador.splice(indiceAleatorio, 1);

            var cajaJugador = document.createElement("li");
            var texto = document.createTextNode(document.getElementById(numAleatorio).textContent);
            cajaJugador.appendChild(texto);

            if (borrador.length + 1 > tope) {
                equipo1.appendChild(cajaJugador);
            } else {
                equipo2.appendChild(cajaJugador);
            }

        }
        var jugadorViejo = document.getElementById(jugadorElegido);
        if (jugadorViejo!=null) {
            jugadorViejo.classList.toggle("elegidoListaSub");
        }

        jugadorElegido = null;
        cajaErrAnadir.innerHTML = "";
        cajaErrBorrar.innerHTML = "";
        cajaErrSortear.innerHTML = "";
    }



}

document.getElementById("btn_anadir").addEventListener("click", anadir, false);
document.getElementById("btn_borrar").addEventListener("click", borrar, false);
document.getElementById("btn_sortear").addEventListener("click", sortear, false);
var identificadorEquipo = 1;
var equipoElegido = null;
var equipos = [];
var idsEquipos = [];
var objEquipos = [];
var totalEncuentros;
var cajaTotalEncuentros = document.getElementById("totalEncuentros");
var indiceEncuentrosLiga = 0;

var cajaErrAnadirEquipo = document.getElementById("errAnadirEquipo");
var cajaErrBorrarEquipo = document.getElementById("errBorrarEquipo");
var cajaErrCrearEquipo = document.getElementById("errcrearEquipo");

class Equipo {
    constructor(pos, nom, pts, v, e, d, gf, gc) {
        this.posicion = pos;
        this.nombre = nom;
        this.puntos = pts;
        this.victorias = v;
        this.empates = e;
        this.derrotas = d;
        this.golFavor = gf;
        this.golContra = gc;
    }

    gana(golFavorEntra, golContraEntra) {
        this.puntos = this.puntos + 3;
        this.victorias = this.victorias + 1;
        this.golFavor = this.golFavor + parseInt(golFavorEntra);
        this.golContra = this.golContra + parseInt(golContraEntra);
    }

    pierde(golFavorEntra, golContraEntra) {
        this.derrotas = this.derrotas + 1;
        this.golFavor = this.golFavor + parseInt(golFavorEntra);
        this.golContra = this.golContra + parseInt(golContraEntra);
    }

    empata(golFavorEntra, golContraEntra) {
        this.puntos = this.puntos + 1;
        this.empates = this.empates + 1;
        this.golFavor = this.golFavor + parseInt(golFavorEntra);
        this.golContra = this.golContra + parseInt(golContraEntra);
    }

}

function anadirEquipo() {

    var equipo = document.getElementById("equipo").value.trim();

    cajaErrAnadirEquipo.innerHTML = "";

    if (equipo.length != 0) {
        if (equipos.length == 16) {
            cajaErrAnadirEquipo.innerHTML = "Máximo de equipos alcanzado";
        } else {
            if (existe(equipo) == false) {
                cajaErrBorrarEquipo.innerHTML = "";
                cajaErrCrearEquipo.innerHTML = "";

                var cajaEquipo = document.createElement("li");
                var texto = document.createTextNode(equipo);
                cajaEquipo.id = "equipo" + identificador;
                idsEquipos.push("equipo" + identificador);
                equipos.push(equipo);
                identificador++;

                cajaEquipo.addEventListener("click", function () {

                    cajaErrAnadirEquipo.innerHTML = "";
                    cajaErrBorrarEquipo.innerHTML = "";
                    cajaErrCrearEquipo.innerHTML = "";
                    this.classList.toggle("elegidoListaSub");

                    if (this.className == "") {
                        equipoElegido = null;
                    } else {
                        if (equipoElegido != null) {
                            var equipoViejo = document.getElementById(equipoElegido);
                            equipoViejo.classList.toggle("elegidoListaSub");
                        }
                        equipoElegido = this.id;
                    }
                });

                cajaEquipo.appendChild(texto);
                if (equipos.length <= 10) {
                    document.getElementById("listaParte1").appendChild(cajaEquipo);
                } else {
                    document.getElementById("listaParte2").appendChild(cajaEquipo);
                }

                if (equipoElegido != null) {
                    var equipoViejo = document.getElementById(equipoElegido);
                    equipoViejo.classList.toggle("elegidoListaSub");
                }
                equipoElegido=null;
                document.getElementById("equipo").value = "";
            } else {
                cajaErrAnadirEquipo.innerHTML = "Ya existe ese equipo";
            }
        }
    } else {
        cajaErrAnadirEquipo.innerHTML = "Campo vacío";
    }
}

function borrarEquipo() {
    cajaErrBorrarEquipo.innerHTML = "";

    if (equipoElegido == null) {
        cajaErrBorrarEquipo.innerHTML = "Ningún elemento seleccionado";
    } else {
        for (let x = 1; x < 3; x++) {
            var idElige = "listaParte" + x;

            var cajaMaestra = document.getElementById(idElige);

            for (let i = 0; i < cajaMaestra.childNodes.length; i++) {

                var equipo = cajaMaestra.childNodes[i];
                if (equipo.id == equipoElegido) {

                    cajaMaestra.removeChild(equipo);
                    i = cajaMaestra.childNodes.length;

                    for (let j = 0; j < idsEquipos.length; j++) {

                        if (equipoElegido == idsEquipos[j]) {
                            idsEquipos.splice(j, 1);
                            equipos.splice(j, 1);
                        }
                    }

                    equipoElegido = null;
                }
            }

        }
        cajaErrAnadirEquipo.innerHTML = "";
        cajaErrCrearEquipo.innerHTML = "";
    }
}

function existe(nombre) {
    var existe = false;
    for (let i = 0; i < equipos.length; i++) {
        if (equipos[i] == nombre) {
            existe = true;
        }
    }
    return existe;
}

function crearTorneo() {
    cajaErrAnadirEquipo.innerHTML = "";
    cajaErrBorrarEquipo.innerHTML = "";
    var tipo = document.getElementById("tipoTorneo").value;
    if (tipo == "liga") {
        if (equipos.length < 3) {
            cajaErrCrearEquipo.innerHTML = "Mínimo 3 equipos";
        } else {
            document.getElementById("OpcionLigaContenedor").className = "sive";
            document.getElementById("OpcionPlayofContenedor").className = "nove";
            crearLiga();
        }
    } else {
        if (equipos.length != 4 && equipos.length != 8 && equipos.length != 16) {
            cajaErrCrearEquipo.innerHTML = "Deben ser 4, 8 o 16 equipos";
        } else {
            document.getElementById("OpcionLigaContenedor").className = "nove";
            document.getElementById("OpcionPlayofContenedor").className = "sive";
            crearPlayoof();
        }
    }
    if (equipoElegido != null) {
        var equipoViejo = document.getElementById(equipoElegido);
        equipoViejo.classList.toggle("elegidoListaSub");
    }
    equipoElegido=null;
}

function crearLiga() {
    var tabla = document.getElementById("tablaLiga");
    var encuentrosOficiales = [];
    limpiarTablaLiga();
    limpiarListaLiga();
    objEquipos = [];
    var borrador = [];
    document.getElementById("diceGanador").innerHTML = "";
    indiceEncuentrosLiga = 0;
    for (let i = 0; i < equipos.length; i++) {
        var nombreEquipo = equipos[i];
        borrador.push(nombreEquipo);
        objEquipos.push(new Equipo(i + 1, nombreEquipo, 0, 0, 0, 0, 0, 0));

        var fila = document.createElement("tr");

        var celda1 = document.createElement("td");
        var texto1 = document.createTextNode(i + 1);
        celda1.appendChild(texto1);

        var celda2 = document.createElement("td");
        var texto2 = document.createTextNode(nombreEquipo);
        celda2.appendChild(texto2);

        fila.appendChild(celda1);
        fila.appendChild(celda2);

        for (let x = 0; x < 6; x++) {
            var celda = document.createElement("td");
            var texto = document.createTextNode("0");
            celda.appendChild(texto);
            fila.appendChild(celda);
        }

        tabla.appendChild(fila);

    }

    var listaEncuentros = document.getElementById("cajaResultadosLiga");

    while (borrador.length != 1) {
        var equipo1 = borrador[0];
        borrador.splice(0, 1);
        var array = [];
        for (let h = 0; h < borrador.length; h++) {
            array.push(borrador[h]);
        }
        for (let y = 0; y < borrador.length; y++) {
            var indiceAleatorio = Math.floor(Math.random() * array.length);
            var numAleatorio = array[indiceAleatorio];
            array.splice(indiceAleatorio, 1);

            var equipoAdversario = numAleatorio;

            var encuentro = document.createElement("div");
            encuentro.className = "encuentro";

            var encuadre = document.createElement("div");
            encuadre.className = "resultadoEncuentro";

            var equip1 = document.createElement("div");
            equip1.className = "equipo1Liga";

            var textoEquip1 = document.createTextNode(equipo1);
            equip1.appendChild(textoEquip1);

            var input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("maxlength", "2");
            input.id = equipo1 + "-" + equipoAdversario;

            equip1.appendChild(input);

            var equip2 = document.createElement("div");
            equip2.className = "equipo2Liga";

            var textoEquip2 = document.createTextNode(equipoAdversario);

            var input2 = document.createElement("input");
            input2.setAttribute("type", "text");
            input2.setAttribute("maxlength", "2");
            input2.id = equipoAdversario + "-" + equipo1;

            equip2.appendChild(input2);
            equip2.appendChild(textoEquip2);

            var boton = document.createElement("button");
            var textito = document.createTextNode("Confirmar");
            boton.appendChild(textito);
            boton.setAttribute("data-param1", input.id);
            boton.setAttribute("data-param2", input2.id);

            boton.addEventListener("click", function () {
                const parametro1 = this.getAttribute("data-param1");
                const parametro2 = this.getAttribute("data-param2");

                var golequip1 = document.getElementById(parametro1);
                var golequip2 = document.getElementById(parametro2);

                if (compruebaResultadoMete(golequip1, golequip2)) {
                    var equipo1Obt = obtenerEquipoPorTexto(parametro1);
                    var equipo2Obt = obtenerEquipoPorTexto(parametro2);
                    var indiceSel = null, nombreSel = null;

                    if (golequip1.value.trim() > golequip2.value.trim()) {
                        nombreSel = obtenerEquipoPorTexto(parametro1);
                        indiceSel = obtenerIndicePorNombre(nombreSel);

                        objEquipos[indiceSel].gana(golequip1.value.trim(), golequip2.value.trim());

                        nombreSel = obtenerEquipoPorTexto(parametro2);
                        indiceSel = obtenerIndicePorNombre(nombreSel);

                        objEquipos[indiceSel].pierde(golequip2.value.trim(), golequip1.value.trim());

                    } else if (golequip1.value < golequip2.value) {
                        nombreSel = obtenerEquipoPorTexto(parametro2);
                        indiceSel = obtenerIndicePorNombre(nombreSel);

                        objEquipos[indiceSel].gana(golequip2.value.trim(), golequip1.value.trim());

                        nombreSel = obtenerEquipoPorTexto(parametro1);
                        indiceSel = obtenerIndicePorNombre(nombreSel);

                        objEquipos[indiceSel].pierde(golequip1.value.trim(), golequip2.value.trim());
                    } else {

                        nombreSel = obtenerEquipoPorTexto(parametro1);
                        indiceSel = obtenerIndicePorNombre(nombreSel);

                        objEquipos[indiceSel].empata(golequip1.value.trim(), golequip2.value.trim());

                        nombreSel = obtenerEquipoPorTexto(parametro2);
                        indiceSel = obtenerIndicePorNombre(nombreSel);

                        objEquipos[indiceSel].empata(golequip2.value.trim(), golequip1.value.trim());
                    }
                    golequip1.setAttribute("disabled", "disabled");
                    golequip2.setAttribute("disabled", "disabled");
                    this.setAttribute("disabled", "disabled");
                    indiceEncuentrosLiga++;
                    cajaTotalEncuentros.innerHTML = indiceEncuentrosLiga + "/" + totalEncuentros;
                    ordenarTabla();
                }
            });

            encuadre.appendChild(equip1);
            encuadre.appendChild(boton);
            encuadre.appendChild(equip2);
            encuentro.appendChild(encuadre);
            encuentrosOficiales.push(encuentro);

        }
    }
    totalEncuentros=encuentrosOficiales.length;
    while (encuentrosOficiales.length != 0) {
        var num = Math.random();
        var indiceAleatorioOficial = Math.floor(num * encuentrosOficiales.length);
        var encuentrofinal = encuentrosOficiales[indiceAleatorioOficial];
        encuentrosOficiales.splice(indiceAleatorioOficial, 1);

        listaEncuentros.appendChild(encuentrofinal);
    }

    cajaTotalEncuentros.innerHTML = indiceEncuentrosLiga + "/" + totalEncuentros;

}

function limpiarTablaLiga() {
    var tabla = document.getElementById("tablaLiga");
    while (tabla.rows.length != 1) {
        tabla.removeChild(tabla.lastChild);
    }
}

function limpiarListaLiga() {
    var listaEncuentros = document.getElementById("cajaResultadosLiga");
    while (listaEncuentros.firstChild) {
        listaEncuentros.removeChild(listaEncuentros.firstChild);
    }
}

function ordenarTabla() {
    limpiarTablaLiga();
    objEquipos.sort((a, b) => {
        if (b.puntos === a.puntos) {
            if (b.victorias === a.victorias) {
                if (b.golFavor === a.golFavor) {
                    return a.golContra - b.golContra;
                }
                return b.golFavor - a.golFavor;
            }
            return b.victorias - a.victorias;
        }
        return b.puntos - a.puntos;
    });

    var tabla = document.getElementById("tablaLiga");

    for (let i = 0; i < objEquipos.length; i++) {
        var fila = document.createElement("tr");

        var celda1 = document.createElement("td");
        var texto1 = document.createTextNode(i + 1);
        celda1.appendChild(texto1);

        fila.appendChild(celda1);

        var equipo = objEquipos[i];

        var celdaNombre = document.createElement("td");
        var textoNombre = document.createTextNode(equipo.nombre);
        celdaNombre.appendChild(textoNombre);
        fila.appendChild(celdaNombre);

        var celdaPuntos = document.createElement("td");
        var textoPuntos = document.createTextNode(equipo.puntos);
        celdaPuntos.appendChild(textoPuntos);
        fila.appendChild(celdaPuntos);

        var celdaVictorias = document.createElement("td");
        var textoVictorias = document.createTextNode(equipo.victorias);
        celdaVictorias.appendChild(textoVictorias);
        fila.appendChild(celdaVictorias);

        var celdaEmpates = document.createElement("td");
        var textoEmpates = document.createTextNode(equipo.empates);
        celdaEmpates.appendChild(textoEmpates);
        fila.appendChild(celdaEmpates);

        var celdaDerrotas = document.createElement("td");
        var textoDerrotas = document.createTextNode(equipo.derrotas);
        celdaDerrotas.appendChild(textoDerrotas);
        fila.appendChild(celdaDerrotas);

        var celdaGolFavor = document.createElement("td");
        var textoGolFavor = document.createTextNode(equipo.golFavor);
        celdaGolFavor.appendChild(textoGolFavor);
        fila.appendChild(celdaGolFavor);

        var celdaGolContra = document.createElement("td");
        var textoGolContra = document.createTextNode(equipo.golContra);
        celdaGolContra.appendChild(textoGolContra);
        fila.appendChild(celdaGolContra);


        tabla.appendChild(fila);

    }

    if (indiceEncuentrosLiga == totalEncuentros) {
        document.getElementById("diceGanador").innerHTML = "Ganador: " + objEquipos[0].nombre;
    }
}

function obtenerIndicePorNombre(nombrePone) {
    for (let i = 0; i < objEquipos.length; i++) {
        var equipo = objEquipos[i];
        if (equipo.nombre == nombrePone) {
            return i;
        }
    }
}

function obtenerEquipoPorTexto(texto) {
    var equipo = texto.substring(0, texto.indexOf("-"));
    return equipo;
}

function compruebaResultadoMete(input1, input2) {
    var bien = true;
    if (input1.value.trim().length == 0 || input2.value.trim().length == 0) {
        bien = false;
    }
    if (isNaN(input1.value) || isNaN(input2.value)) {
        bien = false;
    }
    return bien;
}

var equiposRestantes = [];
var tope = null;
var indiceplayof = 0;

function crearPlayoof() {
    var tablero = document.getElementById("contPlayofResult");
    var lista = document.createElement("ul");
    while (tablero.firstChild) {
        tablero.removeChild(tablero.firstChild);
    }
    equiposRestantes = [];
    var borrador = [];
    indiceplayof = 0;
    tope = equipos.length / 2;
    for (let x = 0; x < equipos.length; x++) {
        borrador.push(equipos[x]);
    }

    for (let i = 0; i < (equipos.length / 2); i++) {
        var indiceAleatorio = Math.floor(Math.random() * borrador.length);
        var equipo1 = borrador[indiceAleatorio];
        borrador.splice(indiceAleatorio, 1);

        indiceAleatorio = Math.floor(Math.random() * borrador.length);
        var equipo2 = borrador[indiceAleatorio];
        borrador.splice(indiceAleatorio, 1);

        var li1 = document.createElement("li");
        var cja1 = document.createElement("div");
        cja1.className = "equipoRestantePlayof";

        var botonEqu1 = document.createElement("button");
        botonEqu1.id = equipo1 + ":" + equipo2;
        botonEqu1.addEventListener("click", pasaEquipo);
        var flecha = document.createElement("i");
        flecha.classList.add("fa-solid");
        flecha.classList.add("fa-circle-chevron-right");
        botonEqu1.appendChild(flecha);

        var textoEqu1 = document.createTextNode(equipo1);

        cja1.appendChild(textoEqu1);
        cja1.appendChild(botonEqu1);
        li1.appendChild(cja1);

        var li2 = document.createElement("li");
        var cja2 = document.createElement("div");
        cja2.className = "equipoRestantePlayof";

        var botonEqu2 = document.createElement("button");
        botonEqu2.id = equipo2 + ":" + equipo1;
        botonEqu2.addEventListener("click", pasaEquipo);
        var flecha2 = document.createElement("i");
        flecha2.classList.add("fa-solid");
        flecha2.classList.add("fa-circle-chevron-right");
        botonEqu2.appendChild(flecha2);

        var textoEqu2 = document.createTextNode(equipo2);

        cja2.appendChild(textoEqu2);
        cja2.appendChild(botonEqu2);
        li2.appendChild(cja2);


        lista.appendChild(li1);
        lista.appendChild(li2);
    }

    tablero.appendChild(lista);
}

function pasaEquipo() {
    var equiposConflicto = this.id;
    this.parentNode.classList.add("fondoVerde");
    var equipo1 = equiposConflicto.substring(0, equiposConflicto.indexOf(":"));
    var equipo2 = equiposConflicto.substring(equiposConflicto.indexOf(":") + 1);

    equiposRestantes.push(equipo1);

    var nuevoId = equipo2 + ":" + equipo1;
    document.getElementById(nuevoId).setAttribute("disabled", "disabled");
    document.getElementById(nuevoId).parentNode.classList.add("fondoRojo");
    this.setAttribute("disabled", "disabled");

    indiceplayof++;
    if (indiceplayof == tope && tope != 1) {
        pasaFase();
    } else if (indiceplayof == tope && tope == 1) {
        finalTorneo();
    }

}

function finalTorneo() {
    var tablero = document.getElementById("contPlayofResult");
    var lista = document.createElement("ul");
    var li = document.createElement("li");
    var cja = document.createElement("div");
    cja.className = "equipoGanadorPlayof";
    var h1 = document.createElement("h1");
    var textoH1 = document.createTextNode("Ganador");
    h1.appendChild(textoH1);
    cja.appendChild(h1);
    var textoEqu = document.createTextNode(equiposRestantes[0]);
    cja.appendChild(textoEqu);
    li.appendChild(cja);
    lista.appendChild(li);
    tablero.appendChild(lista);
}

function pasaFase() {
    var tablero = document.getElementById("contPlayofResult");
    var lista = document.createElement("ul");
    indiceplayof = 0;
    tope = tope / 2;

    var repeticiones = (equiposRestantes.length / 2);

    for (let i = 0; i < repeticiones; i++) {
        var equipo1 = equiposRestantes[0];
        var equipo2 = equiposRestantes[1];
        equiposRestantes.splice(0, 1);
        equiposRestantes.splice(0, 1);

        var li1 = document.createElement("li");
        var cja1 = document.createElement("div");
        cja1.className = "equipoRestantePlayof";

        var botonEqu1 = document.createElement("button");
        botonEqu1.id = equipo1 + ":" + equipo2;
        botonEqu1.addEventListener("click", pasaEquipo);
        var flecha = document.createElement("i");
        flecha.classList.add("fa-solid");
        flecha.classList.add("fa-circle-chevron-right");
        botonEqu1.appendChild(flecha);

        var textoEqu1 = document.createTextNode(equipo1);

        cja1.appendChild(textoEqu1);
        cja1.appendChild(botonEqu1);
        li1.appendChild(cja1);

        var li2 = document.createElement("li");
        var cja2 = document.createElement("div");
        cja2.className = "equipoRestantePlayof";

        var botonEqu2 = document.createElement("button");
        botonEqu2.id = equipo2 + ":" + equipo1;
        botonEqu2.addEventListener("click", pasaEquipo);
        var flecha2 = document.createElement("i");
        flecha2.classList.add("fa-solid");
        flecha2.classList.add("fa-circle-chevron-right");
        botonEqu2.appendChild(flecha2);

        var textoEqu2 = document.createTextNode(equipo2);

        cja2.appendChild(textoEqu2);
        cja2.appendChild(botonEqu2);
        li2.appendChild(cja2);


        lista.appendChild(li1);
        lista.appendChild(li2);
    }
    tablero.appendChild(lista);
}

function limpiarListaJugadores() {
    var lista = document.getElementById("cajaJugadores");
    while (lista.children.length != 1) {
        lista.removeChild(lista.lastChild);
    }
    identificador = 1;
    jugadorElegido = null;
    ids = [];
}

function limpiarListaEquipos() {
    var lista1 = document.getElementById("listaParte1");
    while (lista1.firstChild) {
        lista1.removeChild(lista1.firstChild);
    }
    var lista2 = document.getElementById("listaParte2");
    while (lista2.firstChild) {
        lista2.removeChild(lista2.firstChild);
    }
    identificadorEquipo = 1;
    equipoElegido = null;
    equipos = [];
    idsEquipos = [];

    document.getElementById("OpcionLigaContenedor").className = "nove";
    document.getElementById("OpcionPlayofContenedor").className = "nove";
}

document.getElementById("btn_anadirEquipo").addEventListener("click", anadirEquipo, false);
document.getElementById("btn_borrarEquipo").addEventListener("click", borrarEquipo, false);
document.getElementById("btn_crearEquipo").addEventListener("click", crearTorneo, false);

document.getElementById("btn_limpiarJugadores").addEventListener("click", limpiarListaJugadores, false);
document.getElementById("btn_limpiarEquipos").addEventListener("click", limpiarListaEquipos, false);

function ampliaImagen(){
    document.getElementById("cajaImagen").className="sive";
    document.getElementById("imagenMostrada").setAttribute("src","web/img/"+this.id+".jpeg");
}

for (let z = 1; z < 5; z++) {
    var id="pruebaImg"+z;
    document.getElementById(id).addEventListener("click", ampliaImagen, false);
}

function quitarImagenAmpliada(){
    document.getElementById("cajaImagen").className="nove";
}

document.getElementById("xImg").addEventListener("click", quitarImagenAmpliada, false);

document.getElementById("tipoTorneo").addEventListener("change",function (){
    cajaErrCrearEquipo.innerHTML = "";
});
