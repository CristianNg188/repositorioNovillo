<?php
ob_start();
?>
<main>
    <div id="cajaListaReservas">
        <div id="busqueda">
            
            <?php if ($rolUser=="admin"): ?>
                <h1><a id="iconoVolverLisReservas" href="index.php?action=OpcionesAdmim"><i class="fa-solid fa-circle-left"></i></a>Lista de Reservas</h1>
                <?php else: ?>
                <h1><a id="iconoVolverLisReservas" href="index.php"><i class="fa-solid fa-circle-left"></i></a>Lista de Reservas</h1>
            <?php endif; ?>
            
            <div id="parte1">
                Buscar por
                <select name="atributo" id="filtro">
                    <option value="id" selected>Id</option>
                    <?php if ($rolUser=="admin"): ?>
                        <option value="idUsuario">idUsuario</option>
                    <?php endif; ?>
                    <option value="fechaReserva">fecha de reserva</option>
                    <option value="precio">Precio</option>
                </select>
                <input type="text" id="buscador">
            </div>
            <div id="parte2">
                <button class="btn btn-primary" id="btnCrearReserva">Crear Reserva</button>
            </div>
        </div>

        <table id="tabla">
            <tr class="fondoAzulTabla">
                <th>Id</th>
                <th>idUsuario</th>
                <th>Fecha de reserva</th>
                <th>Precio</th>
                <th>Opciones</th>
            </tr>
            <?php foreach ($reservas as $reserva) : ?>
                <tr id="<?= $reserva->getId() ?>" class="userFiltro">

                    <td><?= $reserva->getId() ?></td>
                    <td><?= $reserva->getIdUsuario() ?></td>
                    <td><?= $reserva->getFecha() ?></td>
                    <td><?= $reserva->getPrecio() ?>€</td>

                    <?php
                        $lr=$lineasReservasDAO->obtenerPorReserva($reserva->getId());
                        $fechaLr=$lr[0]->getFecha();
                    ?>
                    <td class="fondoAzulTabla">
                        <?php if ($fechaLr>date('Y-m-d')): ?>
                            <i class="fa-solid fa-ban borrar" title="Borrar reserva"></i>
                        <?php endif; ?>
                            <i class="fa-solid fa-maximize verDetalle" title="Ver detalles"></i>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php if ($rolUser=="admin"): ?>
            <a href="index.php?action=OpcionesAdmim">Volver</a>
        <?php else: ?>
            <a href="index.php">Volver</a>
        <?php endif; ?>
        
    </div>
</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
