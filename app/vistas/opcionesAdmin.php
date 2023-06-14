<?php
ob_start();
?>
<main class="fondoAzul">

    <div id="caja">

        <div class="opcion">
            <div id="opcionUsers" class="contOpcion punteroRaton">
                <img src="web/img/listaUsers.png" alt="">
                <h3>Lista de Usuarios</h3>
            </div>

        </div>

        <div class="opcion">
            <div id="opcionPistas" class="contOpcion punteroRaton">
                <img src="web/img/listaPistas.png" alt="">
                <h3>Lista de Pistas</h3>
            </div>
        </div>

        <div class="opcion">
            <div id="opcionReservas" class="contOpcion punteroRaton">
                <img src="web/img/listaReservas.png" alt="">
                <h3>Lista de Reservas</h3>
            </div>
        </div>

    </div>

</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
