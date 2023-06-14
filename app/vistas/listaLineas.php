<?php
ob_start();
?>

<main>
    <div id="cajaListaLineas">
        
        <h1><a id="iconoVolverLisLine" href="index.php?action=listarReservas"><i class="fa-solid fa-circle-left"></i></a>Lineas de la Reserva del <?=$fecha?></h1>

        <table id="tabla">
            
            <tr class="fondoAzulTabla">
                <th>IdLinea</th>
                <th>Descripcion</th>
                <th>Numero</th>
                <th>Hora</th>
                <th>Precio</th>
                <?php if ($borrado): ?>
                    <th>Opciones</th>
                <?php endif; ?>
            </tr>
            
            <?php foreach ($lineas as $linea) : ?>
                <tr id="<?= $linea->getId() ?>" class="userFiltro">
                    <td><?= $linea->getId() ?></td>
                    <?php
                        $pista=$pistasDAO->obtener($linea->getIdPista());
                    ?>
                    <td><?= $pista->getDescripcion() ?></td>
                    <td><?= $pista->getNumero() ?></td>
                    <td><?= $linea->getHora() ?></td>
                    <td><?= $pista->getPrecio() ?>€</td>
                    <?php if ($borrado): ?>
                        <td class="fondoAzulTabla">
                            <i class="fa-solid fa-ban borrar" title="Borrar linea"></i>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
                
        </table>
        
        <a href="index.php?action=listarReservas">Volver</a>
        
    </div>
</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';