<?php
session_start();
include('connect.php');
include('genre.php');

//verifier si l'id d'un client est envoyé
if(isset($_GET['id'])) {
$clientSth = $connexion->prepare("select * from clients where id_client=:id");
$clientSth->execute([
  'id' => $_GET['id'],
]);
if(0 === $clientSth->rowCount()) {
  header('location: client.php');
}
$client = $clientSth->fetch(PDO::FETCH_ASSOC);
}

//si le formulaire est envoyé on ajoute les informations en BDD
if($_POST) {
  //Si le client existe on le met à jour.
  if($client){

  }
  //si le client n'existe pas on crée un nouvel enregistrement.
  else {
    //le template de la requête sql
    $requeteClient = "insert into clients (nom, prenom, genre, date_de_naissance, email, telephone)
    values (:nom, :prenom, :genre, :date_de_naissance, :email, :telephone)";
  }

  //preparation de la requête
  $clientSth = $connexion->prepare($requeteClient);
  //on bin les paramètres directement dans la methode execute
  $clientSth->execute([
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'genre' => $_POST['genre'],
    'date_de_naissance' => $_POST['date_de_naissance'],
    'email' => $_POST['email'],
    'telephone' => $_POST['telephone'],
  ]);
  //retourne le nombre de lignes affectées par la fonction execute
  if(0 < $clientSth->rowCount()) {
    //Convertit tous les caractères éligibles en entités HTML
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    //on crée un tableau avec le message d'ajout et la couleur du conteneur du message
    $_SESSION['message'] = [
      'message' => "Le client $nom $prenom a été ajouté",
      'color' => 'success',
    ];
  } else {
      $errorMessage = $clientSth->errorInfo();
      $_SESSION['message'] = [
        'message' => $errorMessage[2],
        'color' => 'danger',
      ];
  }
  //on redirige vers la page d'accueil
  header('location: client.php');
}

include('partials/header.php');
?>
<form
action="client_edit.php<?= (isset($client['id_client'])) ? '?id='.$client['id_client'] : '' ?>" method="post">
  <div class="form-group row">
    <label for="nom" class="col-2 col-form-label">Nom</label>
    <div class="col-10">
      <input class="form-control" type="text" name="nom" value="<?= $client['nom'] ?? '' ?>" id="nom">
    </div>
  </div>
  <div class="form-group row">
    <label for="prenom" class="col-2 col-form-label">Prenom</label>
    <div class="col-10">
      <input class="form-control" type="text" name="prenom" value="<?= $client['prenom'] ?? '' ?>" id="prenom">
    </div>
  </div>
  <div class="form-group row">
    <label for="genre" class="col-2 col-form-label">Genre</label>
    <div class="col-10">
      <select name="genre" class="form-control" id="genre">
           <option value="0">N/D</option>
           <?php foreach($arrayGenre as $cle => $genre): ?>
             <option <?= (isset($client) && $cle == $client['genre'] ? 'selected' : '') ?> value='<?php echo $cle ?>'><?php echo $genre ?></option>
           <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="date_de_naissance" class="col-2 col-form-label">Date de naissance</label>
    <div class="col-10">
      <input class="form-control" type="date" name="date_de_naissance" value="<?= $client['date_de_naissance'] ?? '' ?>" id="date_de_naissance">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-2 col-form-label">Email</label>
    <div class="col-10">
      <input class="form-control" type="text" name="email" value="<?= $client['email'] ?? '' ?>" id="email">
    </div>
  </div>
  <div class="form-group row">
    <label for="telephone" class="col-2 col-form-label">Telephone</label>
    <div class="col-10">
      <input class="form-control" type="text" name="telephone" value="<?= $client['telephone'] ?? '' ?>" id="telephone">
    </div>
  </div>
  <div class="form-group row">
      <div class="col-md-6">
        <a href="client.php">
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
