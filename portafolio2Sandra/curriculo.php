<?php
    /**
     * Portafolio personal modificado con php.
     * @author Sandra Fernández Ávila
     * @version 2.0
     */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/estilo/estilo.css">
    <title>curriculo</title>
</head>
<body>
    <div class="main-container">
        <section class="medio">
            <div class="margenes">
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'].'/includers/header.php');
                ?>
                <div class="detail-container">
                    <div class="texto">
                        En este apartado voy a valorar mis diferentes aptitudes que he obtenido durante el primer curso de DAW
                        <br>
                        <ul>
                            <li><b>Conocimientos en HTML5:</b> Moderados. Todo lo que vimos el año pasado lo se realizar perfectamente 
                                pero considero que unsa pequeña parte dentro de todo lo que se puede hacer. </li>
                            <li><b>Conocimientos en JAVA:</b> Si nos centramos en lo que aprendimos en 1ºDAW, altos.
                                (Hasta interfaces gráficas)</li>
                            <li><b>Conocimientos en SQL:</b> Y lo mismo que con JAVA, altos hasta lo que dimos en primero.</li>
                            <li><b>Conocimientos en PHP:</b> Ninguno, pero espero poder llegar a conocer bastante al final del curso.</li>
                        </ul>
                    </div>
                </div>
                <div class="detail-container">
                    <img src="/imagenes/java.jpg" alt="logo de java" height="300">
                    <img src="/imagenes/sql.jpg" alt="logo sql" height="300">
                    <img src="/imagenes/html5.jpg" alt="logo html5" height="300">
                </div>
            </div>
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'].'/includers/footer.php');
            ?>
        </section>
    </div>
</body>
</html>