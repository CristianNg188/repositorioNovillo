<?php
ob_start();
?>
<main>
    <form action="index.php?action=crearPistas" method="post" id="formulario">

        <fieldset>
            <?php if ($_SESSION['$edita']): ?>
                <legend><a id="iconoVolverRegPista" href="index.php?action=listarPistas"><i class="fa-solid fa-circle-left"></i></a>Modificar Pista</legend>
                <input type="hidden" id="numVerifica" value="<?= $numero ?>">
                <input type="hidden" id="tipoVerifica" value="<?= $tipo ?>">
                <input type="hidden" name="idPistaModifica" value="<?= $id ?>">
            <?php else: ?>
                <legend><a id="iconoVolverRegPista" href="index.php?action=listarPistas"><i class="fa-solid fa-circle-left"></i></a>Crear Pista</legend>
                <input type="hidden" id="numVerifica" value="-1">
                <input type="hidden" id="tipoVerifica" value="-1">
            <?php endif; ?>

            <div id="divTipo" class="apartado anadidos">
                <label>Tipo:<br>
                    <input type="text" name="tipo" class="a" id="tipo" value="<?= $tipo ?>">
                    <select id="selectTipo" name="selectTipo">
                        <option value="">Sin seleccionar</option>
                        <?php foreach ($tipoPistas as $tipillo): ?>
                            <?php if ($tipillo == $tipo): ?>
                                <option value="<?= $tipillo ?>" selected=""><?= $tipillo ?></option>
                            <?php else: ?>
                                <option value="<?= $tipillo ?>"><?= $tipillo ?></option>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </select>
                </label>            
            </div>

            <div class="apartado bonito" id="divNumero">
                <label>Numero:<br>
                    <?php if ($_SESSION['$edita']): ?>
                        <input type="number" name="numero" class="a" id="numero" value="<?= $numero ?>">
                    <?php else: ?>
                        <input type="number" name="numero" class="a" id="numero" value="<?= $numero ?>" disabled>
                    <?php endif; ?>
                </label>
            </div>

            <div id="divDescripcion" class="apartado anadidos">
                <label>Descripcion:<br>
                    <input type="text" name="descripcion" class="a" id="descripcion" value="<?= $descripcion ?>">
                </label>
            </div>

            <div class="apartado bonito" id="divPrecio">
                <label>Precio:<br>
                    <input type="number" name="precio" class="a" id="precio" value="<?= $precio ?>">
                </label>
            </div>

            <div id="caja-envia">
                <?php if ($_SESSION['$edita']): ?>
                    <input type="submit" class="btn btn-primary" value="Editar" id="btn-submit">
                <?php else: ?>
                    <input type="submit" class="btn btn-primary" value="Registrar" id="btn-submit">
                <?php endif; ?>

            </div>
        </fieldset>
    </form>
</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
