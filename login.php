<?php
require('conexion.php');
$email = '';
$errorEmail = '';
$invalidError = '';
if($_POST){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $validator = $conex->query("SELECT * FROM users WHERE email = '{$email}'");
    $cantidad = $validator->rowCount();
    // var_dump($cantidad);exit;
    if($cantidad==0){
        $errorEmail = 'Usuario o Email Incorrectos';
        $invalidError = 'is-invalid';
    } else {
        $usuario = $validator->fetch(PDO::FETCH_ASSOC);
        if(!password_verify($pass, $usuario['password'])){
            $errorEmail = 'Usuario o Email Incorrectos';
            $invalidError = 'is-invalid';
        }else{
            header('location:miPerfil.php');
        }
    }

}

    require_once('plantilla/header.php');
    require_once('plantilla/menu.php');
 ?>

      <section class="principal">
          <article class="nuevas" id="peliculas">
              <div class="peliculas">
              <h2>Login a Digital Movies</h2>

              <form method="post">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control <?= $invalidError ?>" id="email" placeholder="Tu Email" name="email" value="<?= $email ?>">
                    <div class="invalid-feedback"><?= $errorEmail ?></div>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Tu Password" name="password">
                  </div>
                  <div class="form-group">
                      <input type="checkbox" name="rememberme" id="rememberme">
                      <label for="rememberme">Mantenerme logueado</label>
                  </div>

                  <button type="submit" class="btn btn-primary">Login</button>
                </form>
              </div>
          </article>
      </section>

<?php
require_once('plantilla/footer.php'); ?>
