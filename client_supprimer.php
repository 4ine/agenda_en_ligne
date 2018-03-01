<?php
session_start();
include('connect.php');
$id = $_GET['id'] ?? null;
if(null !== $id) {
$_SESSION['suppression_client'] = "le client a été supprimé";
//preparer la requête
$suppressionSth =
$connexion->prepare('delete from clients where id_client = :id');
$suppressionSth->bindParam('id', $id, PDO::PARAM_INT);

$suppressionSth->execute();
}

header('Location: client.php');
