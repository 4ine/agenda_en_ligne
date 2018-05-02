<?php
session_start();
include('connect.php');
include('genre.php');
$message = null;
$adresse = null;

//verifier si le client existe, sinon on redirige vers la page client.php
if(isset($_GET['id_client'])) {
  $clientSth = $connexion->prepare("select * from clients where id_client=:id");
  $clientSth->execute([
    'id' => $_GET['id_client'],
  ]);
  $client = $clientSth->fetch(PDO::FETCH_ASSOC);
}

if (!isset($_GET['id_client']) || !$client) {
  header('location: client.php');
}

//verifier si l'adresse existe
if(isset($_GET['id'])) {

  // * Si l'id de l'adresse est envoyé on récupère l'enregistrement en base
  // * et on stocke l'information dans une variable $adresse

}

//si le formulaire est envoyé on ajoute les informations en BDD
if($_POST) {

  // * formater les données $data

  // * créer le template de requête sql

  // * executer la requête

  // * rediriger sur la bonne page

}

include('partials/header.php');
?>
<?php if(null !== $message): ?>
  <?php $color = $message['color'] ?? 'primary' ?>
  <div class="alert alert-<?php echo $color ?>" role="alert">
  <?php echo $message['message']; ?>
  </div>
<?php endif; ?>
<form
action="adresse_edit.php?id_client=<?= $client['id_client'] ?><?= $adresse ? '&id=' . $adresse['id_adresse']  : '' ?>" method="post">
  <div class="form-group row">
    <label for="numero" class="col-2 col-form-label">N°</label>
    <div class="col-10">
      <input class="form-control" type="number" name="numero" value="<?= $adresse['numero'] ?? '' ?>" id="numero">
    </div>
  </div>
  <div class="form-group row">
    <label for="rue" class="col-2 col-form-label">Rue</label>
    <div class="col-10">
      <input class="form-control" type="text" name="rue" value="<?= $adresse['rue'] ?? '' ?>" id="rue">
    </div>
  </div>
  <div class="form-group row">
    <label for="code_postal" class="col-2 col-form-label">Code postal</label>
    <div class="col-10">
      <input class="form-control" type="text" name="code_postal" value="<?= $adresse['code_postal'] ?? '' ?>" id="code_postal">
    </div>
  </div>
  <div class="form-group row">
    <label for="ville" class="col-2 col-form-label">Ville</label>
    <div class="col-10">
      <input class="form-control" type="text" name="ville" value="<?= $adresse['ville'] ?? '' ?>" id="ville">
    </div>
  </div>
  <div class="form-group row">
      <div class="col-md-6">
        <a href="client_edit.php?id=<?= $_GET['id_client'] ?>">
          <button type="button" class="btn btn-default">Retour</button>
        </a>
      </div>
    <div class="col-md-6 text-right">
      <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
  </div>
</form>
<?php

include('partials/footer.php');
