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
$requeteSuppClient = "delete from clients where id_client = :id";
//preparation de la requête
$suppressionSth =
$connexion->prepare($requeteSuppClient);
//liaison du nom ':id' à la variable id
$suppressionSth->bindParam('id', $id, PDO::PARAM_INT);

//si la suppression a fonctionné, on ajoute un message
$suppressionSth->execute();

//Retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute()
$rowCount = $suppressionSth->rowCount();

//s'il y a au moins une ligne qui a été supprimée on indique un message
if(0 < $rowCount) {
  $_SESSION['suppression_client'] = "le client a été supprimé";
}

}

//on redirige vers la page client
header('Location: client.php');
