<?php
try{
    $opt= [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    $conex = new PDO('mysql:host=localhost;dbname=movies_db', 'juancarlos', '123456', $opt);
    //echo '<pre>';
    // var_dump($conex);

    //$query = $conex->query('SELECT * FROM genres WHERE ranking >= 10');
    $query = $conex->query('SELECT * FROM genres');

    $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    echo 'No me pude conectar a la BD<br>';
    echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <ul>
            <?php
                foreach ($resultados as $genero) {
                    echo '<li>'.$genero['name'].'</li>';
                }
            ?>
        </ul>
    </body>









</html>
