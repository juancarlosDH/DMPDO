<?php
try{
    //esto muestra los errores con nombres de tablas y campos
    $opt= [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //esto codifica para que no tenga errores de acentos
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
    
    $conex = new PDO('mysql:host=localhost;dbname=movies_db', 'juancarlos', '123456', $opt);
    //echo '<pre>';
    // var_dump($conex);

}catch(PDOException $e){
    echo 'No me pude conectar a la BD<br>';
    echo $e->getMessage();
}
