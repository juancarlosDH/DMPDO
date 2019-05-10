<html>
    <head>
        <title>Agregar Pelicula</title>
    </head>
    <body>

      <form method="post" action="?movie_id=<?=$_GET['id']?>">

        <input type="hidden" name="movie_id" value="<?=$_GET['id']?>">

          <div class="form-group">
            <div>
                <label for="titulo">Titulo</label>
                <input type="text" name="title" id="title"/>
            </div>
            <div>
                <label for="rating">Rating</label>
                <input type="text" name="rating" id="rating"/>
            </div>
            <div>
                <label for="premios">Premios</label>
                <input type="text" name="awards" id="awards"/>
            </div>
            <div>
                <label for="length">Duracion</label>
                <input type="text" name="length" id="length"/>
            </div>

            <div>
                <label for="duracion">Extreno</label>
                <input type="date" name="release_date" id="release_date"/>
            </div>

            <input type="submit" value="Agregar Pelicula" name="submit"/>
        </form>
    </body>
</html>
