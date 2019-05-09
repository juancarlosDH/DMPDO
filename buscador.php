<?php
require('conexion.php');
$titulo='';
$tituloResultado='';
$idResultado='';
$resultadoBusqueda=[];
$errorBusqueda='';
$tipo='';
$cantidad = 0;
$query = $conex->query("SELECT * FROM genres");
$generos = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['tipo'])) {
    $titulo=trim($_GET['title']);
    $tipo=$_GET['tipo'];

    if($tipo=='movies'){
        $consulta="SELECT * FROM movies WHERE title LIKE ?";
    }else{
        $consulta="SELECT * FROM series WHERE title LIKE ?";
    }

    //if(!empty($_GET['genero'])){
    //     $consulta="SELECT * FROM {$tipo} WHERE title LIKE '%{$titulo}%'
    //         AND genre_id = {$_GET['genero']}";
    // }

    $query = $conex->prepare($consulta);

    $query->execute( [ '%'.$titulo.'%' ] );

    //var_dump($query); die;

    $cantidad = $query->rowCount();
    //veo si hay o no $resultados
    if( $cantidad >= 1){
        $resultados= $query->fetchAll(PDO::FETCH_ASSOC);
        $errorBusqueda = '';
    }else{
        $resultados=[];
        $errorBusqueda='No se ha encontrado, intente con otro titulo.';

    }



    // foreach ($resultados as $resultado) {
    //   if (strlen(stristr($resultado['title'],$titulo))>0) {
    //     $tituloResultado=$resultado['title'];
    //     $idResultado=$resultado['id'];
    //     array_push($resultadoBusqueda,$tituloResultado,$idResultado);
    //     } else {
    //   }
    // };
    //var_dump($resultadoBusqueda); exit;
}

    require_once('plantilla/header.php');
    require_once('plantilla/menu.php');
 ?>

    <section class="principal">

      <article class="nuevas" id="peliculas">
        <div name='buscador' class="peliculas">
          <h2>Buscador</h2>
          <form class="" action="" method="get">
            <input type="radio" name="tipo" id="movies" value="movies" checked>
            <label for="movies">Película</label>
            <input type="radio" name="tipo" id="series" value="series">
            <label for="series">Serie</label>
            <label for="title"></label>
            <input class="form-control form-control-lg" type="text" name="title" placeholder="¿Que vas a ver hoy?">
            <select name="genero">
                <option value="">Todos</option>
                <?php
                foreach ($generos as $genero) {
                echo "<option value='{$genero['id']}'>".$genero['name']."</option>";
                }
                 ?>
            </select>
            <button class="btn btn-primary" type="submit">Buscar</button>
          </form>
          <div class="">
              <h4>Resultados de la Busqueda</h4>
              <?php
              if($cantidad>=1){
                  foreach ($resultados as $resultadoBusqueda) {
                      if ($tipo=='series') {
                          echo "<a href='serie.php?serie_id={$resultadoBusqueda['id']}'><h3>".$resultadoBusqueda['title']."</h3></a>";
                      } elseif ($tipo=='movies') {
                          echo "<a href='detallePelicula.php?id={$resultadoBusqueda['id']}'><h3>".$resultadoBusqueda['title']."</h3></a>";
                      }
                  }
              }else {echo $errorBusqueda;}
              ?>

          </div>
        </div>

      </article>

    </section>
<?php
require_once('plantilla/footer.php');
 ?>
