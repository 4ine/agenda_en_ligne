<?php
$dsn = 'mysql:dbname=agenda_en_ligne;host=localhost';
$user = 'root';
$password = 'samueloo';

//attrape une exception potentielle
try{
  //connexion à la BDD
  $connexion = new PDO($dsn, $user, $password);
}
//retourne un message d'erreur lorsqu'une
// exception est levée
catch (\Exception $e){
 echo $e->getMessage();
}
