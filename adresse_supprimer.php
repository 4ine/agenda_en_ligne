<?php
//démarre une nouvelle session ou reprend une session existante
session_start();
//recuperation de la connexion à la BDD
include('connect.php');
//récupération de l'id de l'enregistrement que l'on va supprimer
$id = $_GET['id'] ?? null;
//si l'id n'est pas null, on va supprimer l'enregistrement
if(null !== $id) {
//le template de la requête sql
$requeteSuppAdresse = "delete from adresse where id_adresse = :id";
//preparation de la requête
$suppressionSth =
$connexion->prepare($requeteSuppAdresse);
//liaison du nom ':id' à la variable id
$suppressionSth->bindParam('id', $id, PDO::PARAM_INT);

//execution de la requête
$suppressionSth->execute();

//Retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute()
$rowCount = $suppressionSth->rowCount();

//s'il y a au moins une ligne qui a été supprimée on indique un message
if(0 < $rowCount) {
  $_SESSION['message'] = [
    'color' => 'danger',
    'message' => 'L\'adresse a été supprimée',
  ];
}
}


//on redirige vers la page client
if (isset($_GET['id_client'])) {
  header('Location: client_edit.php?id='.$_GET['id_client']);
} else {
  header('Location: client.php');
}
