<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>DEPORT</title>
        <link rel="icon" href="web/img/logo.png" type="image/png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
              integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
                integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="web/css/style.css">
        <link rel="stylesheet" href="web/css/style-<?= $pagina ?>.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Laila:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>

        <header id="cabecera">

            <div id="circulo"></div>

            <?php if (isset($_SESSION['usuario'])): ?>

                <div id="sesionUser" class="punteroRaton efectoInicio">

                    <div id="textoSesion">
                        <?= $_SESSION['usuario'] ?>
                    </div>
                    
                    <?php if ($usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getFoto()!=null): ?>
                        <img src="web/imagenes/<?=
                        $usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getFoto();
                        ?>" alt="Icono usuario" id="icSesion">
                    <?php else: ?>
                        <img src="web/img/icono.png" alt="Icono usuario" id="icSesion">
                    <?php endif; ?>
                    
                </div>

                <ul id="opcionesUser">
                    <li><a href="index.php?action=PerfilUsuario&id=<?= $_SESSION['idUsuario'] ?>&pagina=<?= $pagina ?>">Perfil</a></li>
                    <?php if ($usuarioDAO->obtenerPorId($_SESSION['idUsuario'])->getRol() == "admin"): ?>
                        <li><a href="index.php?action=OpcionesAdmim">Opciones</a></li>
                     <?php else: ?>
                        <li><a href="index.php?action=listarReservas">Mis reservas</a></li>
                    <?php endif; ?>
                    <li><a href="index.php?action=logout">Cerrar Sesion</a></li>
                </ul>

            <?php else: ?>
                <div id="inicioSesion">

                    <div id="textoSesion">
                        Iniciar Sesión
                    </div>

                    <img src="web/img/icono.png" alt="Icono usuario" id="icSesion">

                </div>
            <?php endif; ?>
        </header>

        <nav>
            
            <?php if ($pagina=="inicio"): ?>
                <a id="navSele" href="index.php?action=inicio">
                    <i class="fa-solid fa-house"></i>Inicio</a>
            <?php else: ?>
                <a class="navNoSele" href="index.php?action=inicio">
                    <i class="fa-solid fa-house"></i>Inicio</a>
            <?php endif; ?>
            
            
            <?php if ($pagina=="noticias"): ?>
                <a id="navSele" href="index.php?action=noticias">
                    <i class="fa-solid fa-newspaper"></i>Noticias</a>
            <?php else: ?>
                <a class="navNoSele" href="index.php?action=noticias">
                    <i class="fa-solid fa-newspaper"></i>Noticias</a>
            <?php endif; ?>
            
            
            <?php if ($pagina=="actividades"): ?>
                <a id="navSele" href="index.php?action=actividades">
                    <i class="fa-solid fa-futbol"></i>Actividades</a>
            <?php else: ?>
                <a class="navNoSele" href="index.php?action=actividades">
                    <i class="fa-solid fa-futbol"></i>Actividades</a>
            <?php endif; ?>
            
            
            <?php if ($pagina=="reservar"): ?>
                <a id="navSele" href="index.php?action=reservar">
                    <i class="fa-solid fa-bookmark"></i>Reserva</a>
            <?php else: ?>
                <a class="navNoSele" href="index.php?action=reservar">
                    <i class="fa-solid fa-bookmark"></i>Reserva</a>
            <?php endif; ?>


            <?php if ($pagina=="mi"): ?>
                <a id="navSele" href="index.php?action=mi">
                    <i class="fa-solid fa-circle-info"></i>Sobre Mí</a>
            <?php else: ?>
                <a class="navNoSele" href="index.php?action=mi">
                    <i class="fa-solid fa-circle-info"></i>Sobre Mí</a>
            <?php endif; ?>

        </nav>

        <?php print $vista; ?>

        <footer>
            <h5>Copyright © 2023 Cristian Novillo Gómez. Todos los derechos reservados.</h5>
            <div id="copy">
                <img src="web/img/DEPORT.png" alt="nombre web"><br>
                <div id="infoFooter">
                    <p>
                        <a target="_blank" href="web/documentos/Política de Privacidad de Deport.pdf">Política de privacidad</a>
                        <a target="_blank" href="web/documentos/ayuda.pdf">Ayuda</a>
                        <a target="_blank" href="web/documentos/Política de Cookies de Deport.pdf">Política de Cookies</a>
                    </p>
                    <p>
                        <a target="_blank" href="https://www.instagram.com/codetosatomelloso/"><i class="fa-brands fa-instagram"></i></a>
                        <a target="_blank" href="https://www.facebook.com/people/Complejo-Deportivo-Tomelloso-Codetosa/100067619958585/?locale=es_ES"><i class="fa-brands fa-facebook"></i></a>
                        <a target="_blank" href="https://twitter.com/enTomelloso"><i class="fa-brands fa-twitter"></i></a>
                    </p>
                </div>
            </div>
        </footer>
        
        <?php if (!isset($_SESSION['usuario'])): ?>
        
            <?php if (MensajeFlash::tieneErroresSesion()==true): ?>
                <div id="cajaSesion" class="ve">
            <?php else: ?>
                <div id="cajaSesion" class="nove">
            <?php endif; ?>
            <form action="index.php?action=login" method="post" id="FormSesion">

                <a id="x"><i class="fa-solid fa-circle-xmark"></i></a>
                <h1>Iniciar sesion</h1>
                
                <?php if (MensajeFlash::tieneErroresSesion()==true): ?>
                    <div id="errorInicioSesion">
                        Usuario o contraseña incorrectos
                    </div>
                    <?=MensajeFlash::quitarErrores()?>
                <?php endif; ?>
                
                <fieldset>
                    <div class="mb-3 mt-3">
                        <label for="nombre" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="nombre" name="usuario" required="">
                    </div>

                    <div class="mb-3">
                        <label for="pwd" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="pwd" name="contra" required="">
                    </div>

                    <div id="modEspInputIndex">
                        <input type="checkbox" id="recuerda" name="recuerda">
                        <label for="recuerda">Recordar la sesion</label>
                    </div>

                    <input type="hidden" name="pagina" value="<?= $pagina ?>">

                    <button type="submit" class="btn btn-primary">Iniciar sesion</button>
                </fieldset>

                <a href="index.php?action=registroUser">Registrarse</a>

            </form>

        </div>
        
        <script src="web/js/script-noUser.js"></script>
        <?php else: ?>
        <script src="web/js/script-siUser.js"></script>
        <?php endif; ?>
        
        <?php if (MensajeFlash::tieneErroresGenericos()==true): ?>
            <div id="cajaContMensErr">
                <div id="cajaMensajeErr">
                    <?=MensajeFlash::imprimirMensajes()?>
                    <button class="btn btn-primary" id="btnOkErr">Entendido</button>
                </div>
            </div>
            <script src="web/js/script-errGenericos.js"></script>
        <?php endif; ?>
        
        <?php if ($pagina!="mi" && $pagina!="confirmarReserva"): ?>
            <script src="web/js/script-<?= $pagina ?>.js"></script>
        <?php endif; ?>
    </body>
</html>
