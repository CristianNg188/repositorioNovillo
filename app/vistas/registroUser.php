<?php
ob_start();
?>

<main>
    <div id="email1" class="aparece">
        <div class="centradoa">
            <h1>Email</h1>
            <p>Introduzca su email para continuar</p>
        </div>
        <div id="emailIntro">
            <div id="muestra_valido"></div>
            <input type="email" name="email" class="a2" id="email">
            <button id="btn" disabled><i class="fa-solid fa-chevron-right"></i></button>
        </div>

    </div>

    <form action="index.php?action=registroUser" method="post" id="email2" class="desaparece">
        <div class="centradoa">
            <h1>Creación de Cuenta</h1>
            <p>Introduzca su usuario y contraseña para finalizar el registro.</p>
        </div>

        <div class="apartadoRegisBonito" id="divUser">Usuario:</div>
        <input type="text" name="usuario" class="a2" id="usuario" value="<?= $user ?>">

        <div class="apartadoRegisBonito" id="divContra">Contraseña:</div>
        <input type="password" name="contra" class="a2" id="contra">

        <div class="apartadoRegisBonito" id="divContra2">Repite la contraseña:</div>
        <input type="password" name="contra2" class="a2" id="contra2">

        <div class="apartadoRegisBonitoEsp">
            <button id="btnAtrasRegisUs"><i class="fa-solid fa-chevron-left"></i></button>
            <input type="submit" id="enviar" value="Registrarse">
        </div>

        <input type="hidden" name="correo" id="correo">
    </form>
</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
