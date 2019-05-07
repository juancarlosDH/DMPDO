<?php
    require('conexion.php');

    $query = $conex->query('SELECT * FROM genres');

    $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

     require_once('plantilla/header.php');
     require_once('plantilla/menu.php');
  ?>
    <section class="principal">
        <article class="nuevas" id="peliculas">
            <div class="peliculas">
                <h2>Generos en Digital Movies</h2>

                <ul>
                <?php
                    foreach ($resultados as $genero) {
                        echo '<li>'.$genero['name'].'</li>';
                    }
                ?>
                </ul>
            </div>
        </article>
    </section>
<?php
require_once('plantilla/footer.php'); ?>
