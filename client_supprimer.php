<?php
session_start();
include('connect.php');
$id = $_GET['id'] ?? null;
if(null !== $id) {
$_SESSION['suppression_client'] = "le client a été supprimé";


}

header('Location: client.php');
