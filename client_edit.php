<?php
session_start();
include('connect.php');
include('genre.php');
$message = null;
$histos = [];
if(isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  unset($_SESSION['message']);
}
$client = null;
$adresses = [];
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


  //récupération de l'historique du client
  $histoSth = $connexion->prepare("SELECT  * from histo WHERE JSON_EXTRACT(raw, '$.id_client') = :id");
  $id_client = (int) $_GET['id'];
  $histoSth->bindParam('id',$id_client , PDO::PARAM_INT);
  $histoSth->execute();
  $histos = $histoSth->fetchAll(PDO::FETCH_ASSOC);

  //récuperation des adresses du client
  $adresseSth = $connexion->prepare("select * from adresse where clients_id_client=:id");
  $adresseSth->execute([
    'id' => $_GET['id'],
  ]);
  $adresses = $adresseSth->fetchAll(PDO::FETCH_ASSOC);
}

//si le formulaire est envoyé on ajoute les informations en BDD
if($_POST) {
  $data = [
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'genre' => $_POST['genre'],
    'date_de_naissance' => $_POST['date_de_naissance'],
    'email' => $_POST['email'],
    'telephone' => $_POST['telephone'],
  ];
  //Convertit tous les caractères éligibles en entités HTML
  $nom = htmlspecialchars($_POST['nom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  //Si le client existe on le met à jour.
  if($client) {
      $requeteClient = "update clients set nom=:nom, prenom=:prenom, genre=:genre,
      date_de_naissance=:date_de_naissance, email=:email, telephone=:telephone
      where id_client=:id";
      $data['id'] = $client['id_client'];
      $message= "Le client $nom $prenom a été modifé";
  }
  //si le client n'existe pas on crée un nouvel enregistrement.
  else {
    //le template de la requête sql
    $requeteClient = "insert into clients (nom, prenom, genre, date_de_naissance, email, telephone)
    values (:nom, :prenom, :genre, :date_de_naissance, :email, :telephone)";
    $message= "Le client $nom $prenom a été ajouté";
  }

  //preparation de la requête
  $clientSth = $connexion->prepare($requeteClient);
  //on bin les paramètres directement dans la methode execute
  $clientSth->execute($data);

  //retourne le nombre de lignes affectées par la fonction execute
  if(0 < $clientSth->rowCount()) {
    //on crée un tableau avec le message d'ajout et la couleur du conteneur du message
    $_SESSION['message'] = [
      'message' => $message,
      'color' => 'success',
    ];
    //on redirige vers la page d'accueil
    header('location: client.php');
  } else {
      $errorMessage = $clientSth->errorInfo();
      $message = [
        'message' => $errorMessage[2],
        'color' => 'danger',
      ];
  }
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
<?php if($client): ?>
  <div class="form-group row">
    <label class="col-2 col-form-label">Date création</label>
    <div class="col-10">
      <?php
      if(null === $client['date_creation']) {
        echo 'N/D';
      } else {
        $date = new \DateTime($client['date_creation']);
        echo $date->format('d/m/Y à H:m');
      }
      ?>
    </div>
  </div>
  <?php if($histos): ?>
    <div class="form-group row">
      <label  class="col-12 col-form-label">Histo</label>
      <div class="col-12">
        <ul class="list-group">
          <?php foreach($histos as $histo): ?>
            <?php $raw = json_decode($histo['raw']) ?>
            <li class="list-group-item">
                <div class="row">
                  <div class="col-2"><?= $raw->nom ?></div>
                  <div class="col-2"><?= $raw->prenom ?></div>
                  <div class="col-1"><?= $raw->genre ?></div>
                  <div class="col-3"><?= $raw->email ?></div>
                  <div class="col-2"><?= $raw->telephone ?></div>
                </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php if (isset($client['id_client'])): ?>
  <div class="row">
    <div class="col-12 text-right">
      <a href="adresse_edit.php?id_client=<?= $client['id_client'] ?>">
        <button type="button" class="btn btn-success">Ajouter une adresse</button>
      </a>
    </div>

  <?php foreach($adresses as $key => $adresse): ?>
    <div class="col-4">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Adresse n°<?= ($key+1) ?></h5>
          <p class="card-text"><?= $adresse['rue'] . ' n°' . $adresse['numero'] . ', ' . $adresse['code_postal'] . ' ' . $adresse['ville'] ?></p>
          <a href="adresse_edit.php?id=<?= $adresse['id_adresse'] ?>&id_client=<?= $client['id_client']?>" class="card-link">Modifier</a>
          <a href="adresse_supprimer.php?id_client=<?= $client['id_client']?>&id=<?= $adresse['id_adresse'] ?>" class="card-link">Supprimer</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
  <br />
<?php endif; ?>

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
