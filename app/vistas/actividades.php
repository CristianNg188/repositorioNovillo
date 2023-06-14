<?php
ob_start();
?>
<main class="fondoAzul">

    <div id="cajaActividades">

        <div id="tituloPrincipal">
            <h1 id="acti">Actividades</h1>
        </div>

        <div id="contInstalaciones">

            <div id="listasPistas">
                Nuestras instalaciones cuentan con:<br>
                <strong>Pistas de fútbol</strong>
                <ul>
                    <li>
                        Fútbol 11: 22€/hora
                    </li>
                    <li>
                        Fútbol 7: 14€/hora
                    </li>
                    <li>
                        Sala: 10€/hora
                    </li>
                </ul>
                <strong>Pistas de baloncesto</strong>
                <ul>
                    <li>
                        Normal: 10€/hora
                    </li>
                    <li>
                        Profesional: 18€/hora
                    </li>
                </ul>
                <strong>Pistas de tenis</strong>
                <ul>
                    <li>
                        Profesional: 8€/hora
                    </li>
                </ul>
            </div>

            <div id="conFotosPistasAct">
                <img src="web/img/pruebaImg1.jpeg" class="imagenPrevias" id="pruebaImg1" alt="imagen de prueba 1">
                <img src="web/img/pruebaImg4.jpeg" class="imagenPrevias" id="pruebaImg4" alt="imagen de prueba 4">
                <img src="web/img/pruebaImg2.jpeg" class="imagenPrevias" id="pruebaImg2" alt="imagen de prueba 2">
                <img src="web/img/pruebaImg3.jpeg" class="imagenPrevias" id="pruebaImg3" alt="imagen de prueba 3">
            </div>

        </div>

        <h1 id="anadidos" class="tituloAct">Añadidos</h1>

        <div class="tituloAnadido">
            <h6>Creación de equipos <a target="_blank" href="web/documentos/Creación de equipos.pdf"><i class="fa-solid fa-circle-info"></i></a></h6>
        </div>

        <div id="creacionEquipos">
            <div id="cajaJugadores">
                <button class="btn btn-primary" id="btn_limpiarJugadores"><i class="fa-solid fa-rotate-left"></i></button>
            </div>

            <div id="cajaAgregacion">

                <p>Nombre del jugador:
                    <input class="form-control" placeholder="Nombre del jugador" type="text" id="jugador"
                           maxlength="18">
                </p>
                <div class="cajaOpcSorteo">
                    <button class="btn btn-primary" id="btn_anadir">Añadir</button>
                    <p id="errAnadir"></p>
                </div>

                <div class="cajaOpcSorteo">
                    <button class="btn btn-primary" id="btn_borrar">Borrar</button>
                    <p id="errBorrar"></p>
                </div>

                <div class="cajaOpcSorteo">
                    <button class="btn btn-primary" id="btn_sortear">Sortear</button>
                    <p id="errSortear"></p>
                </div>


            </div>

            <div id="cajaFinalEquipos">

                <ul id="listaEquipo1">

                </ul>

                <ul id="listaEquipo2">

                </ul>

            </div>

        </div>

        <div class="tituloAnadido">
            <h6>Creación de competiciones <a target="_blank" href="web/documentos/Creación de Competiciones.pdf"><i class="fa-solid fa-circle-info"></i></a></h6>
        </div>

        <div id="contTorneos">

            <div id="listaEquipos">
                <button class="btn btn-primary" id="btn_limpiarEquipos"><i class="fa-solid fa-rotate-left"></i></button>
                <ul id="listaParte1">

                </ul>

                <ul id="listaParte2">

                </ul>

            </div>

            <div id="cajaAgregacionEquipo">

                <p>Nombre del equipo:
                    <input class="form-control" placeholder="Nombre del equipo" type="text" id="equipo"
                           maxlength="15">
                    <select id="tipoTorneo">
                        <option value="liga" selected>Liga</option>
                        <option value="playoff">Playoff</option>
                    </select>
                </p>
                <div class="cajaOpcEquipo">
                    <button class="btn btn-primary" id="btn_anadirEquipo">Añadir</button>
                    <p id="errAnadirEquipo"></p>
                </div>

                <div class="cajaOpcEquipo">
                    <button class="btn btn-primary" id="btn_borrarEquipo">Borrar</button>
                    <p id="errBorrarEquipo"></p>
                </div>

                <div class="cajaOpcEquipo">
                    <button class="btn btn-primary" id="btn_crearEquipo">Crear</button>
                    <p id="errcrearEquipo"></p>
                </div>

            </div>
        </div>

        <div id="OpcionLigaContenedor" class="nove">

            <div id="contTotal">
                <p id="diceGanador">

                </p>
                <p id="totalEncuentros">

                </p>
            </div>

            <table id="tablaLiga">
                <tr id="filaEspLiga">
                    <th>Posición</th>
                    <th>Equipo</th>
                    <th>Pts</th>
                    <th>V</th>
                    <th>E</th>
                    <th>D</th>
                    <th>GF</th>
                    <th>GC</th>
                </tr>
            </table>

            <div id="cajaResultadosLiga">

                <!--Ejemplo
                <div class="encuentro">

                    <div class="resultadoEncuentro">

                        <div class="equipo1Liga">
                            aaaaaaaaaaaaaaaaaa
                            <input type="text" maxlength="2">
                        </div>

                        <button>confirmar</button>

                        <div class="equipo2Liga">
                            <input type="text" maxlength="2">
                            aaaaaaaaaaaaaaaaaa
                        </div>

                    </div>

                </div>
                -->

            </div>

        </div>

        <div id="OpcionPlayofContenedor" class="nove">
            <div id="contPlayofResult">
            </div>
        </div>
    </div>
    
    <div id="cajaImagen" class="nove">

        <div id="cajaImagenPrueba">
            <a id="xImg"><i class="fa-solid fa-circle-xmark"></i></a>
            <img id="imagenMostrada" alt="Imagen ampliada">
        </div>

    </div>

</main>
<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
