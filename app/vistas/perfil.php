<?php
ob_start();
?>
<main class="fondoAzul">
    
    <?php if ($userPropio): ?>
        <input id="banderaUser" type="hidden" value="true">
    <?php else: ?>
        <input id="banderaUser" type="hidden" value="false">
    <?php endif; ?>
    
    <div id="perfil">
        <a id="iconoVolverPerfil" href="index.php?action=<?= $paginaAnterior ?>"><i class="fa-solid fa-circle-left"></i></a>
        <div id="cont_foto">
            <button class="btn btn-primary nove" id="btn_quitarFoto"><i class="fa-solid fa-x"></i></button>
            <?php if ($usuario->getFoto() == null || $usuario->getFoto() == ""): ?>
                <img id="foto" src="web/imagenes/default.png">
            <?php else: ?>
                <img id="foto" src="web/imagenes/<?= $usuario->getFoto() ?>">
            <?php endif; ?>
            <div id="errorFoto"></div>
            
        </div>

        <div id="cont_info">

            <div id="opcionesEditUser">
                
                <button class="btn btn-primary" id="btn_edit">Editar</button>
                <button class="btn btn-primary nove" id="btn_cancelar">Cancelar</button>
                
                <?php if ($userPropio): ?>
                
                <div id="botonesEsp" class="nove">
                    <button class="btn btn-primary" id="btn_cambiaContra">Cambiar contraseña</button>
                    <button class="btn btn-primary" id="btn_darseBaja">Darse de baja</button>
                </div>
                    
                <?php endif; ?>
                    
            </div>

            <form action="index.php?action=PerfilUsuario" method="post" id="info" enctype="multipart/form-data">
                <input id="idUserMod" name="id" type="hidden" value="<?= $usuario->getId() ?>">
                <input id="ponerImagen" name="ponerImagen" type="hidden" value="false">
                <input id="paginitilla" name="paginitilla" type="hidden" value="<?=$paginaAnterior?>">
                
                <p>Usuario:  
                    <input id="user" name="usuario" class="a" type="text" disabled value="<?= $usuario->getUsuario() ?>">
                </p>
                
                <p id="pmail">Correo electrónico:  
                    <input id="mail" name="email" class="inputEdit a" type="email" disabled value="<?= $usuario->getEmail() ?>">
                </p>
                
                <p id="pnombre">Nombre completo:  
                    <input id="nombre" name="nombre" class="inputEdit a" type="text" disabled value="<?= $usuario->getNombre() ?>">
                </p>
                
                <p>DNI:  
                    <input class="a" id="dni" type="text" disabled value="<?= $usuario->getDni() ?>">
                </p>
                
                <p id="ptel">Teléfono:  
                    <input id="tel" name="telefono" class="inputEdit a" type="number" disabled value="<?= $usuario->getTelefono() ?>">
                </p>
                
                <p id="ppoblacion">Población:  
                    <input id="poblacion" name="poblacion" class="inputEdit a" type="text" disabled value="<?= $usuario->getPoblacion() ?>">
                </p>
                
                <input type="file" name="foto" id="imputFotoOculto" accept=".jpg, .gif, .png, .webp">
                <input id="btn_guarda" class="btn btn-primary nove" type="submit" value="Guardar">
            </form>
        </div>

    </div>
    <?php if ($userPropio): ?>
        <div id="cajaOpcionesUser" class="nove">
            <a id="xContraCamb"><i class="fa-solid fa-circle-xmark"></i></a>
            <div id="FormBaja" class="nove">
                <p>¿Estás seguro?</p>
                <button class="btn btn-primary" id="btn_siDaBaja">SI</button>
                <button class="btn btn-primary" id="btn_noDaBaja">NO</button>
            </div>
            <div id="FormContra" class="nove">
                <div id="errNuevaContra"></div>
                <p>Nueva contraseña</p>
                <input type="password" id="nuevaContra">
                <p>Repite contraseña</p>
                <input type="password" id="nuevaContra2">
                <p id="enlCambiaContra">Cambiar contraseña</p>
            </div>
        </div>
    <?php endif; ?>
        
</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
