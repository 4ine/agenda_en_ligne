<?php
session_start();
include('connect.php');
include('genre.php');
if($_POST) {
  $requeteInsertClient = "insert into clients (nom, prenom, genre, date_de_naissance, email, telephone)
  values (:nom, :prenom, :genre, :date_de_naissance, :email, :telephone)";
  $insertClientSth = $connexion->prepare($requeteInsertClient);
  $insertClientSth->bindParam('nom', $_POST['nom']);
  $insertClientSth->bindParam('prenom', $_POST['prenom']);
  $insertClientSth->bindParam('genre', $_POST['genre']);
  $insertClientSth->bindParam('date_de_naissance', $_POST['date_de_naissance']);
  $insertClientSth->bindParam('email', $_POST['email']);
  $insertClientSth->bindParam('telephone', $_POST['telephone']);

  $insertClientSth->execute();

  if(0 < $insertClientSth->rowCount()) {
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $_SESSION['message'] = [
      'message' => "Le client $nom $prenom a été ajouté",
      'color' => 'success',
    ];

    header('location: client.php');
  }
}

include('partials/header.php');
?>
<form action="client_edit.php" method="post">
  <div class="form-group row">
    <label for="nom" class="col-2 col-form-label">Nom</label>
    <div class="col-10">
      <input class="form-control" type="text" name="nom" value="" id="nom">
    </div>
  </div>
  <div class="form-group row">
    <label for="prenom" class="col-2 col-form-label">Prenom</label>
    <div class="col-10">
      <input class="form-control" type="text" name="prenom" value="" id="prenom">
    </div>
  </div>
  <div class="form-group row">
    <label for="genre" class="col-2 col-form-label">Genre</label>
    <div class="col-10">
      <select name="genre" class="form-control" id="genre">
           <option>N/D</option>
           <?php foreach($arrayGenre as $cle => $genre): ?>
             <option value='<?php echo $cle ?>'><?php echo $genre ?></option>
           <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="date_de_naissance" class="col-2 col-form-label">Date de naissance</label>
    <div class="col-10">
      <input class="form-control" type="date" name="date_de_naissance" value="" id="date_de_naissance">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-2 col-form-label">Email</label>
    <div class="col-10">
      <input class="form-control" type="text" name="email" value="" id="email">
    </div>
  </div>
  <div class="form-group row">
    <label for="telephone" class="col-2 col-form-label">telephone</label>
    <div class="col-10">
      <input class="form-control" type="text" name="telephone" value="" id="telephone">
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
