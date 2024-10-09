<?php

try{
    $conectar = new PDO("mysql:host=db;port=3306;dbname=simpleloginsys", "user", "userpass");
} catch(PDOexception $e){
    echo "Falha ao conectar!";
}


?>