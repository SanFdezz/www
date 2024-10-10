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
    <title>hobbies</title>
</head>
<body>
    <div class="main-container">
        <section class="medio">
            <div class="margenes">
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'].'/includers/header.php');
                ?>
                <div class="texto">
                    <p>Tengo muchos hobbies y me gusta mucho dedicar mi tiempo libre sobre todo a cualquier ámbito artístico.
                        Esculpo figuras, tejo peluches, ropa, coso, escribo, bailo... Pero lo que más me gusta y que más
                        que un hobbie es una pasión, es el dibujo/ilustración.
                    </p>
                    Estos son unos ejemplos de mis dibujos:
                </div>
                <div class="detail-container">
                    <img src="/imagenes/dibujo3.png" alt="Dibujo de un personaje original" height="300">
                    <img src="/imagenes/dibujo2.png" alt="ejemplo de dibujo" height="300">
                    <img src="/imagenes/dibujo1.png" alt="ejemplo de dibujo" height="300">
                </div>
            </div>
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'].'/includers/footer.php');
            ?>
        </section>
    </div>
</body>
</html>