<?php
ob_start();
?>
<main class="fondoAzul">

    <div id="caja">

        <div id="parte1">

            <div id="personal">

                <div id="datosImagen">

                    <img id="yo" src="web/img/cristian.jpeg" alt="">

                    <ul>
                        <li>
                            <strong>Nombre:</strong> Cristian Novillo Gómez
                        </li>
                        <li>
                            <strong>Edad:</strong> 19 años
                        </li>
                        <li>
                            <strong>Telefono:</strong> 600 23 33 82
                        </li>
                    </ul>

                    <a target="_blank" href="web/documentos/Cristian Curriculum.pdf">Curriculum</a>

                </div>

                <img class="silueta" src="web/img/siluetaFurbo.png" alt="">

                <div id="lenguajes">
                    <h5>CONOCIMIENTOS INFORMÁTICOS:</h5>
                    <ul>
                        <li>Java</li>
                        <li>HTML</li>
                        <li>CSS</li>
                        <li>JavaScript</li>
                        <li>PHP</li>
                    </ul>
                    <ul>
                        <li>SQL</li>
                        <li>REACT</li>
                        <li>SASS</li>
                        <li>Angular</li>
                        <li>Spring Boot</li>
                    </ul>
                </div>

            </div>

            <div id="descr">
                <div class="bloqueDesc">
                    <h5>DESCRIPCIÓN:</h5>
                    <p>
                        Apasionado de la tecnología y programación, 
                        con una formación full-stack centrada en el desarrollo web. 
                        Comprometido con las nuevas tendencias y tecnologías para dar soluciones eficientes. 
                        Gran capacidad de aprendizaje y cooperación en equipo. Busco oportunidades para crecer 
                        profesionalmente con  proyectos interesantes y desafiantes.
                    </p>
                </div>


                <img src="web/img/siluetaTenis.png" class="silueta" alt="">

                <div class="bloqueDesc" id="bloqueEspc">
                    <h5>FORMACIÓN ACADÉMICA:</h5>
                    <p>
                        BACHILLERATO DE CIENCIAS DE LA SALUD (2019-2021)<br>
                        IES ALTO GUADIANA<br>
                        TOMELLOSO<br><br>

                        CF Grado Superior (2021-actualidad)<br>
                        Desarrollo de aplicaciones Web<br>
                        IES JUAN BOSCO<br>
                        Alcázar De San Juan<br>
                    </p>
                </div>


            </div>

        </div>

        <div id="parte2">
            <div id="contIframe">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3093.5390571912885!2d-3.0005800234678577!3d39.162464431019686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd68fb9f56160f53%3A0x24a669ed6fa409cb!2sComplejo%20Deportivo%20Codetosa!5e0!3m2!1ses!2ses!4v1684856549151!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <p>Bo. Codetosa, 27, 13700 Tomelloso, Ciudad Real</p>
        </div>

    </div>

</main>
<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
