<?php

  //exemple connexion à BDD MySQL
  define('USER',"root");
  define('PASSWORD',"");
  define('SERVER',"localhost");
  define('BASE',"school");

  //fonction de connexion à la base pour factoriser :
  function connect_bd(){
    $dsn="mysql:dbname=".BASE.";host=".SERVER;
    try{
      $connexion=new PDO($dsn,USER,PASSWORD);
      $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOExeption $e){
      printf("Echec de la connexion : %s\n", $e->getMessage());
      exit();
    }
    return $connexion;
  }


?>