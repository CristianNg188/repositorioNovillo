<?php
ob_start();
?>
<main>
    
    <form action="index.php?action=registroAdmin" method="post" id="formulario">

        <fieldset>
            <legend><a id="iconoVolverRegisAdmin" href="index.php?action=listarUsuarios"><i class="fa-solid fa-circle-left"></i></a>Registrar Usuario</legend>
            <div id="divCorreo" class="apartado anadidos">
                <label>Correo electrónico:<br>
                    <input type="email" name="email" class="a" id="email" value="<?= $email ?>">
                </label>            
            </div>

            <div class="apartado bonito" id="divNombre">
                <label>Nombre completo:<br>
                    <input  type="text" name="nombre" class="a" id="nombre" value="<?= $nombre ?>">
                </label>
            </div>

            <div id="divDni" class="apartado anadidos">
                <label>DNI:<br>
                    <input type="text" name="dni" class="a" id="dni" value="<?= $dni ?>">
                </label>
            </div>

            <div class="apartado bonito" id="divTelefono">
                <label>Telefono:<br>
                    <input type="number" name="tel" class="a" id="telefono" value="<?= $telefono ?>">
                </label>
            </div>

            <div class="apartado anadidos" id="divPoblacion">
                <label>Población:<br>
                    <input type="text" name="poblacion" class="a" id="poblacion" value="<?= $poblacion ?>">
                </label>
            </div>

            <div class="apartado bonito">Rol:
                <select name="rol">
                    <?php if ($rol == "user"): ?>
                        <option value="admin">Administrador</option>
                        <option value="user" selected>Usuario</option>
                    <?php else: ?>
                        <option value="admin" selected>Administrador</option>
                        <option value="user">Usuario</option>
                    <?php endif; ?>
                </select>
            </div>

            <div id="caja-envia">
                <input class="btn btn-primary" type="submit" value="Registrar" id="btn-submit">
            </div>
        </fieldset>
    </form>
</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
