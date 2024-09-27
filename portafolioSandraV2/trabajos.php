<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/estilo/estilo.css">
    <title>trabajos</title>
</head>
<body>
    <div class="main-container">
        <section class="medio">
            <div class="margenes">
                <?php
                    require_once(__DIR__.'/includers/header.php');
                ?>
                <div class="detail-container">
                    <div class="texto">
                        <p>Este apartado va a estar un poco vacío ya que no he trabajado de manera real en nada todavia ya
                            que me he dedicado exclusivamente a estudiar todo este tiempo.
                        </p>
                        Los únicos "trabajos" que he realizados son comisiones de dibujo y cuidados de niños en mi tiempo libre.
                        <br>
                        <br>
                        Tras las prácticas de este año mi objetivo es continuar trabajando y asi crear ya mi experiencia laboral en el sector. 
                    </div>
                </div>
                <div class="detail-container">
                    <img src="/imagenes/niñera.jpg" alt="imagen en representación del trabajo de niñera" height="300">
                    <img src="/imagenes/comisiones.jpg" alt="imagen en representación de las comisiones de dibujo" height="300">
                </div>
            </div>
            <?php
                require_once(__DIR__.'/includers/footer.php');
            ?>
        </section>
    </div>
</body>
</html>