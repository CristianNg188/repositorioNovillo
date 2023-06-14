<?php
ob_start();
?>

<div id="carouselExample" class="carousel slide">

    <div class="carousel-indicators" id="fondoBotones">
        <button id="btn1" type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button id="btn2" type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button id="btn3" type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button id="btn4" type="button" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="web/img/Img1carrusel.png" class="d-block w-100" alt="Imagen 1">
        </div>
        <div class="carousel-item">
            <img src="web/img/Img2carrusel.png" class="d-block w-100" alt="Imagen 2">
        </div>
        <div class="carousel-item">
            <img src="web/img/Img3carrusel.png" class="d-block w-100" alt="Imagen 3">
        </div>
        <div class="carousel-item">
            <img src="web/img/Img4carrusel.png" class="d-block w-100" alt="Imagen 4">
        </div>
    </div>

    <button class="carousel-control-prev" id="flecha1" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" id="flecha2" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>

</div>

<main class="fondoAzul">

    <div class="cajitaA">
        <img src="web/img/siluetaFurboSinFondo.png" alt="">
    </div>

    <div id="contSections">

        <section id="noticias">

            <h3 class="tituloSection">Noticias</h3>

            <div id="contTexto">
                En la sección de noticias encontrarás todas las novedades sobre las 
                instalaciones, así como otras noticias relevantes en el mundo del deporte. 
                Te invitamos a investigar nuestras noticias con los nuevos filtros de búsqueda
                que te permitirán encontrarlas más rápidamente, desde buscar por la fecha de publicación hasta 
                un índice personalizado. Todo son ventajas con DEPOR, ahora gratis para los usuarios que no están 
                registrados y que solo buscan saber más del centro.
            </div>

            <div id="contNoticias">

                <article id="noti1">
                    <img src="web/img/noticia1.PNG" alt="Imagen de la noticia">
                    <h6>Nueva página web</h6>
                    <p>Nos complace anunciar el lanzamiento de nuestra nueva página 
                        web del Polideportivo "DEPORT". Esta plataforma ha sido cuidadosamente 
                        diseñada...
                    </p>
                </article>

                <div id="conPar">
                    <article id="noti2">
                        <img src="web/img/noticia2.jpeg" alt="Imagen de la noticia">
                        <div class="TextoNoticiaLao">
                            <h6>Celebración de torneo de tenis</h6>
                            <p> DEPORT se enorgullece en presentarles
                                nuestro emocionante torneo de tenis...
                            </p>
                        </div>
                    </article>

                    <article id="noti3" class="noticiaEspecial">
                        <img src="web/img/noticia3.jpeg" alt="Imagen de la noticia">
                        <div class="TextoNoticiaLao">
                            <h6>Construcción de pista de fútbol</h6>
                            <p>Nuestra nueva pista de fútbol en DEPORT será una joya moderna y de vanguardia...
                            </p>
                        </div>
                    </article>
                </div>

                <div class="notis">

                    <article id="noti4">
                        <img src="web/img/noticia4.jpeg" alt="Imagen de la noticia">
                        <div class="TextoNoticiaLaoNuevo">
                            <h6>Espacio seguro para niños</h6>
                            <p class="nuevotextoEsp">Espacio especialmente diseñado para que los niños...
                            </p>
                        </div>
                    </article>

                    <article id="noti5">
                        <img src="web/img/noticia5.jpeg" alt="Imagen de la noticia">
                        <div class="TextoNoticiaLaoNuevo">
                            <h6>Importancia del agua</h6>
                            <p class="nuevotextoEsp">La hidratación es esencial...
                            </p>
                        </div>
                    </article>

                    <article id="noti6">
                        <img src="web/img/reservas.jpeg" alt="Imagen de la noticia">
                        <div class="TextoNoticiaLaoNuevo">
                            <h6>Nuevo sistema de reservas</h6>
                            <p class="nuevotextoEsp">Innovador sistema de reservas diseñado...
                            </p>
                        </div>
                    </article>

                </div>

            </div>

        </section>

        <section id="opciones">
            <h3 class="tituloSection">Opciones</h3>

            <article id="opcion1">
                <div class="contOpciones">
                    <h1>Reserva</h1>
                    <p>Si eres un usuario registrado podrás realizar tu reserva de pista
                        el día y la hora disponible entre las 09:00-22:00. Para ello tendrás que 
                        iniciar sesión antes de reservar para confirmar tus datos. Si todavía no estás 
                        registrado, ¡A que esperas! Pasate por nuestros centros y un administrador 
                        le recogerá sus datos.
                    </p>
                </div>

            </article>

            <article id="opcion2">
                <div class="contOpciones">
                    <h1>Actividades</h1>
                    <p>Además de la sección de noticias anteriormente comentada, nuestra página 
                        web también informará de las actividades que ofrecemos al público, las cuales 
                        se organizarán de forma ordenada para el buen entendimiento del usuario. Esta parte 
                        no requiere de estar registrado ya que es información para los interesados. Se diferencia
                        con la sección de noticias en la puesta al usuario de los deportes, tarifas y todo 
                        lo relacionado de manera oficial y estática.
                    </p>
                </div>
            </article>

            <article id="opcion3">
                <div class="contOpciones">
                    <h1>Añadidos</h1>
                    <p>Disfrute de los añadidos que complementarán sus actividades favoritas. Estos son: creador de equipos, el cual 
                        creará los equipos de forma aleatoria según los nombres dados; creador de competiciones, 
                        este creará una competición que el usuario especifique y pondrá los equipos proporcionados 
                        de forma aleatoria de acuerdo a la competición elegida.
                    </p>
                </div>
            </article>

        </section>

    </div>

    <div class="cajitaA">
        <img src="web/img/siluetaTenisSinFondo.png" alt="">
    </div>

</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
