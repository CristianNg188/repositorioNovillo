<?php
ob_start();
?>
<main>

    <div id="contFecha">
        <input type="date" value="<?= $fecha ?>" id="calendario" min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')) ?>">
        <button class="btn btn-primary" id="btnConfirmaReserva">Confirmar reservas</button>
    </div>

    <table>

        <tr class="fondoAzulTabla">
            <th>Tipo</th>
            <?php
            foreach ($tiposDeporte as $tipo) {
                $numCel = 0;
                foreach ($pistas as $pista) {
                    if ($pista->getTipo() == $tipo) {
                        $numCel = $numCel + 1;
                    }
                }
                print "<th colspan='$numCel'>$tipo</th>";
            }
            ?>
        </tr>

        <tr class="fondoAzulTabla">
            <th>Numero</th>
            <?php
            foreach ($pistas as $pista) {
                $numero = $pista->getNumero();
                print "<th>$numero</th>";
            }
            ?>
        </tr>

        <tr class="fondoAzulTabla">
            <th>Descripcion</th>
            <?php
            foreach ($pistas as $pista) {
                $desc = $pista->getDescripcion();
                print "<th>$desc</th>";
            }
            ?>
        </tr>

        <?php
        for ($y = 9; $y < 23; $y++) {
            print "<tr>";
            print "<td  class='fondoAzulTabla'>$y:00</td>";

            foreach ($pistas as $pista) {
                $pista instanceof Pista;
                $id = $pista->getId();
                $libre = true;

                foreach ($reservas as $reserva) {
                    $reserva instanceof Reserva;
                    foreach ($lineasReservas as $lineaReserva) {
                        $lineaReserva instanceof lineaReserva;
                        if ($lineaReserva->getIdReserva() == $reserva->getId()) {
                            $idPistaComp = $lineaReserva->getIdPista();
                            $fechaPistaComp = $lineaReserva->getFecha();
                            $horaPistaComp = $lineaReserva->getHora();
                            if ($idPistaComp == $id && $horaPistaComp == $y && $fechaPistaComp == $fecha) {
                                $libre = false;
                            }
                        }
                    }
                }

                if ($libre) {
                    print "<td id='$id-$y' class='libre'>Reservar</td>";
                } else {
                    print "<td id='$id-$y' class='cogido'>Reservado</td>";
                }
            }

            print "</tr>";
        }
        ?>

    </table>
</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
