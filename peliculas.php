<?php
    require('conexion.php');

    //preparo y ejecuto la consulta de las pelis
    $query = $conex->prepare('SELECT * FROM movies');
    $query->execute();
    $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

    //preparo la consulta del genero
    $queryGenero = $conex->prepare('SELECT * FROM genres WHERE id = ?');

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
            $queryGenero->execute([ $peli['genre_id'] ]);
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
