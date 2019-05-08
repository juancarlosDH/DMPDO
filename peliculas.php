<?php
    require('conexion.php');

    $query = $conex->query('SELECT * FROM movies');

    $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

     require_once('plantilla/header.php');
     require_once('plantilla/menu.php');
  ?>
       <section class="principal">
           <article class="nuevas" id="peliculas">
               <div class="peliculas">
               <h2>Peliculas en Digital Movies</h2>

               <ul>
                   <?php
                       foreach ($resultados as $peli) {
                           //me traigo el genero de esta peli
        if(isset($peli['genre_id'])){
            $queryGenero = $conex->query('SELECT * FROM genres WHERE id = '.$peli['genre_id']);
            $genero = $queryGenero->fetch(PDO::FETCH_ASSOC);
            $nombreGenero = $genero['name'];
        }else{
            $nombreGenero = 'Sin Genero';
        }
        //imprimo el titulo de la peli y su genero
   echo '<a href="detallePelicula.php?id='.$peli['id'].'"><li>'.$peli['title'].' ('.$nombreGenero.')</li></a>';
                       }
                   ?>
               </ul>


               </div>
           </article>
       </section>

<?php
require_once('plantilla/footer.php'); ?>
