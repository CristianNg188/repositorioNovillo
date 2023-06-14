<?php
ob_start();
?>
<main>
    <div  id="cajaListaPistas">
        <div id="busqueda">
            <h1><a id="iconoVolverLisPistas" href="index.php?action=OpcionesAdmim"><i class="fa-solid fa-circle-left"></i></a>Lista de Pistas</h1>
            <div id="parte1">
                Buscar por
                <select name="atributo" id="filtro">
                    <option value="id" selected>Id</option>
                    <option value="tipo">Tipo</option>
                    <option value="descripcion">Descripcion</option>
                    <option value="precio">Precio</option>
                </select>
                <input type="text" id="buscador">
            </div>
            <div id="parte2">
                <button class="btn btn-primary" id="btnCrearPista">Crear pista</button>
            </div>
        </div>

        <table id="tabla">
            <tr class="fondoAzulTabla">
                <th>Id</th>
                <th>Tipo</th>
                <th>Numero</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Opciones</th>
            </tr>
            <?php foreach ($pistas as $pista) : ?>
                <tr id="<?= $pista->getId() ?>" class="userFiltro">

                    <td><?= $pista->getId() ?></td>
                    <td><?= $pista->getTipo() ?></td>
                    <td><?= $pista->getNumero() ?></td>
                    <td><?= $pista->getDescripcion() ?></td>
                    <td><?= $pista->getPrecio() ?></td>


                    <td class="fondoAzulTabla">
                        <i class="fa-solid fa-pen-to-square editar" title="Editar pista"></i>
                        <i class="fa-solid fa-ban borrar" title="Borrar pista"></i>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php?action=OpcionesAdmim">Volver</a>
    </div>
</main>
<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
