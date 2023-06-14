<?php
ob_start();
?>
<main class="fondoAzul">

    <div id="cuerpito">
        <a id="iconoVolverReserva" href="index.php?action=reservar"><i class="fa-solid fa-circle-left"></i></a>
        <h1>Resumen de las reservas del dia <?= $_SESSION['fecha'] ?></h1>

        <div id="cajita1">
            <form action="index.php?action=confirmarReserva" method="POST">
                <input type="submit" class="btn btn-primary" name="boton" value="confirmar">
            </form>
        </div>

        <div id="cajita2">
            <table>

                <tr class="fondoAzulTabla">
                    <th>Pista</th>
                    <th>Descripción</th>
                    <th>Hora</th>
                    <th>Precio</th>
                </tr>

                <?php
                $total = 0;
                foreach ($lineas as $linea) {
                    $linea instanceof lineaReserva;

                    $pista = $pistasDAO->obtener($linea->getIdPista());
                    $pista instanceof Pista;

                    $descrPistaMostrar = $pista->getDescripcion();
                    $NumPistaMostrar = $pista->getNumero();
                    $horaPistaMostrar = $linea->getHora();
                    $precioPistaMostrar = $pista->getPrecio();

                    $total = $total + $precioPistaMostrar;

                    print "<tr>";
                    print "<td>$NumPistaMostrar</td>";
                    print "<td>$descrPistaMostrar</td>";
                    print "<td>$horaPistaMostrar:00</td>";
                    print "<td>$precioPistaMostrar €/hora</td>";
                    print "</tr>";
                }
                ?>
            </table>
        </div>
        <h1>Total <?= $total ?>€</h1>
    </div>
</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
