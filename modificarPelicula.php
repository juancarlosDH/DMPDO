<html>
<?php
  require_once('conexion.php');
  $mensaje = '';
  if($_POST){
    if(isset($_POST['modificar'])){

      $sql = 'UPDATE movies
       SET title = :title, awards = :awards, rating = :rating, length = :length
       WHERE id = :movie_id';
       $query = $conex->prepare($sql);
       $query->bindValue(':title', $_POST['title']);
       $query->bindValue(':awards', $_POST['awards']);
       $query->bindValue(':rating', $_POST['rating']);
       $query->bindValue(':length', $_POST['length']);
       $query->bindValue(':movie_id', $_GET['id'] );
       $query->execute();
       $mensaje = 'Pelicula Modificada Exitosamente';
     }
     if(isset($_POST['eliminar'])){
       //elimino los registros asociados en la tabla de actores y peliculas
       $sql = 'DELETE from actor_movie WHERE movie_id = :movie_id';
       $query = $conex->prepare($sql);
       $query->bindValue(':movie_id', $_GET['id'] );
       $query->execute();

       //elimino la peli
       $sql = 'DELETE from movies WHERE id = :movie_id';
       $query = $conex->prepare($sql);
       $query->bindValue(':movie_id', $_GET['id'] );
       $query->execute();
       header('location:peliculas.php');
     }

  }





  $query = $conex->prepare('SELECT * FROM movies WHERE id = :id');
  $query->bindValue(':id', $_GET['id']);
  $query->execute();
  $resultado = $query->fetch(PDO::FETCH_ASSOC);

  require_once('plantilla/header.php');
  require_once('plantilla/menu.php');
 ?>
 <section class="principal">
     <article class="nuevas" id="peliculas">
         <div class="peliculas">

           <?php var_dump($_POST); ?>

      <form method="post" action="modificarPelicula.php?id=<?= $resultado['id'] ?>">
          <div class="form-group">
            <div>
                <label for="titulo">Titulo</label>
                <input type="text" name="title" id="title" value="<?= $resultado['title']?>"/>
            </div>
            <div>
                <label for="rating">Rating</label>
                <input type="text" name="rating" id="rating" value="<?= $resultado['rating']?>"/>
            </div>
            <div>
                <label for="premios">Premios</label>
                <input type="text" name="awards" id="awards" value="<?= $resultado['awards']?>"/>
            </div>
            <div>
                <label for="length">Duracion</label>
                <input type="text" name="length" id="length" value="<?= $resultado['length']?>"/>
            </div>
            <div class="">
              <?= $mensaje ?>
            </div>
            <input class="btn btn-primary" type="submit" value="Modificar Pelicula" name="modificar"/>

            <input class="btn btn-danger" type="submit" value="Eliminar Pelicula" name="eliminar"/>
        </form>

      </article>
  </section>

<?php
require_once('plantilla/footer.php'); ?>
