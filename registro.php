<?php
require('conexion.php');
$errorEmail = '';
$invalidError = '';
if($_POST){
    //INSERT INTO users (name, email, password) VALUES ('Pepito', 'pepe@pepe.com', '123456')
    // $conex->query("INSERT INTO users (name, email, password)
    //  VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['password']."') ");

    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $validator = $conex->query("SELECT email FROM users WHERE email = '{$email}'");
    $cantidad = $validator->rowCount();
    // var_dump($cantidad);exit;
    if($cantidad==0){
        $conex->query("INSERT INTO users (name, email, password)
        VALUES ('{$nombre}', '{$email}', '{$pass}') ");

    } else {
        $errorEmail = 'El mail existe';
        $invalidError = 'is-invalid';
    }

}

    require_once('plantilla/header.php');
    require_once('plantilla/menu.php');
 ?>

      <section class="principal">
          <article class="nuevas" id="peliculas">
              <div class="peliculas">
              <h2>Unirme a Digital Movies</h2>

              <form method="post">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Tu Nombre" name="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control <?= $invalidError ?>" id="email" aria-describedby="emailHelp" placeholder="Tu Email" name="email">
                    <div class="invalid-feedback"><?= $errorEmail ?></div>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Tu Password" name="password">
                  </div>
                  <div class="form-group">
                    <label for="confirmar_password">Confirmar Password</label>
                    <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" placeholder="Confirmacion del Password">
                  </div>

                  <button type="submit" class="btn btn-primary">Unirme</button>
                </form>
              </div>
          </article>
      </section>

<?php
require_once('plantilla/footer.php'); ?>
