<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/estilo/estilo.css">
        <title>Portafolio Sandra</title>
    </head>
    <body>
        <div class="main-container">
            <section class="medio">
                <div class="margenes">
                    <?php
                        require_once(__DIR__.'/includers/header.php');
                    ?>
                    <div class="detail-container">
                        <img src="/imagenes/yo.jpg" alt="Una foto de mi misma" height="300">
                        <div class="texto">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p>Hola, mi nombre es <b>Sandra Fernández Ávila</b> y soy estudiante de 2ºDAW en Valencia.
                                Tengo 18 años actualmente y soy una persona bastante creativa, trabajadora y charlatana.
                            </p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
                <?php
                    require_once(__DIR__.'/includers/footer.php');
                ?>
            </section>
        </div>

    </body>
</html>