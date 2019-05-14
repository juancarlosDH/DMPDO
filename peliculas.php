<?php
    require('conexion.php');

    $consultaCantidad = 'SELECT * FROM movies';
    $queryCantidad = $conex->query($consultaCantidad);
    $cantidad = $queryCantidad->rowCount();

    $cantidad = ceil($cantidad / 6);

    $orden = "ORDER BY movies.title";

    if(isset($_GET['orden'])) {
      if($_GET['orden']== 'title'){
        $orden = "ORDER BY movies.title";
      }
     if($_GET['orden']== 'genero'){
        $orden = "ORDER BY genres.name";
      }
      if($_GET['orden']== 'rating'){
         $orden = "ORDER BY movies.rating DESC";
       }
       if($_GET['orden']== 'awards'){
          $orden = "ORDER BY movies.awards DESC";
        }
    }
    $salto = 0;
    if(isset($_GET['pagina'])){
      $salto = ($_GET['pagina']-1)*6;
    }
    //preparo y ejecuto la consulta de las pelis
    $consulta = "SELECT movies.id, movies.title, genres.name AS nombreGenero, movies.rating, movies.awards
     FROM movies
     LEFT JOIN genres ON movies.genre_id = genres.id
      $orden
    LIMIT $salto, 6";

    $query = $conex->prepare($consulta);
    $query->execute();
    $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

    //preparo la consulta del genero
    //$queryGenero = $conex->prepare('SELECT * FROM genres WHERE id = ?');

     require_once('plantilla/header.php');
     require_once('plantilla/menu.php');
  ?>
       <section class="principal">
           <article class="nuevas" id="peliculas">
               <div class="peliculas">
               <h2 class="titulo-nav">
                 <div >
                   Peliculas en Digital Movies
                 </div>
                 <div class="">
                   <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="peliculas.php?orden=title">Titulo</a></li>
                    <li class="breadcrumb-item"><a href="peliculas.php?orden=genero">Genero</a></li>
                    <li class="breadcrumb-item "><a href="?orden=rating">Rating</a></li>
                    <li class="breadcrumb-item active"><a href="?orden=awards">Awards</a></li>
                  </ol>
                 </div>
                 <nav >
                   <ul class="pagination">
                     <li class="page-item">
                       <a class="page-link" href="#" aria-label="Previous">
                         <span aria-hidden="true">&laquo;</span>
                         <span class="sr-only">Previous</span>
                       </a>
                     </li>
                     <?php for($i = 1; $i <= $cantidad; $i++ ){
                       echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
                     }
                      ?>

                     <li class="page-item">
                       <a class="page-link" href="#" aria-label="Next">
                         <span aria-hidden="true">&raquo;</span>
                         <span class="sr-only">Next</span>
                       </a>
                     </li>
                   </ul>
                 </nav>
               </h2>

               <div class="card-group">

                   <?php
                       foreach ($resultados as $peli) {
                           //me traigo el genero de esta peli
        // if(isset($peli['genre_id'])){
        //     $queryGenero->execute([ $peli['genre_id'] ]);
        //     $genero = $queryGenero->fetch(PDO::FETCH_ASSOC);
        //     $nombreGenero = $genero['name'];
        // }else{
        //     $nombreGenero = 'Sin Genero';
        // }
        //imprimo el titulo de la peli y su genero
        ?>
        <div class="card">
          <img class="card-img-top" src="images/default.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?= $peli['title'] ?></h5>
            <p class="card-text"><?= $peli['nombreGenero'] ?></p>
            <p class="card-text">Rating: <?= $peli['rating'] ?></p>
            <p class="card-text">Awards: <?= $peli['awards'] ?></p>
            <p class="card-text">
              <a class="btn btn-primary" href="detallePelicula.php?id=<?= $peli['id'] ?>">Ver Mas</a>
              <a class="btn btn-success" href="modificarPelicula.php?id=<?= $peli['id'] ?>">Editar</a>
              </p>
          </div>
        </div>
      <?php } ?>
              </div>


               </div>
           </article>
       </section>

<?php
require_once('plantilla/footer.php'); ?>
