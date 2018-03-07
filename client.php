<?php
session_start();
include('connect.php');
include('genre.php');
$message = null;
if(isset($_SESSION['suppression_client']))
{
  $message = $_SESSION['suppression_client'];
  unset($_SESSION['suppression_client']);
}


//Vérifie si la propriété page existe, si elle existe on la renvoie
//en convertissant le resultat en int sinon on retourne la page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$search = !empty($_GET['search']) ? $_GET['search'] : null;

$genre = !empty($_GET['genre']) ? (int)$_GET['genre'] : null;

//coalesce en php, on prend la premiere valeur si elle existe
//et si elle est différente de null sinon on renvoie la valeur
//suivante. Ce code fait la même chose que celui du dessus.
//$page = $_GET['page'] ?? 1;

//initialisation des variables pour la pagination
// limit : la quantité d'enregistrements qu'on va afficher par page
$limit = 5;
// offset : décalage
$offset = ($page-1)*$limit ;

//requête pour récupérer les clients
$requeteClient = "select * from clients";
$recherche = '';
if(null !== $search)
{
  $recherche .= " where nom like :search or prenom like :search ";
}
if(null !== $genre)
{
    $recherche .= empty($recherche) ? ' where ' : ' and ';
    $recherche .= " genre = :genre ";
}
//ajoute les conditions à la requête
$requeteClient .= $recherche;
$requeteClient .= " limit :limit offset :offset";

//preparation d'une requête (on récupère un object PDOStatement)
$clientSth = $connexion->prepare($requeteClient);
if(null !== $search)
{
  $clientSth->bindValue('search',  "%" . $search. "%");
}
if(null !== $genre)
{
    $clientSth->bindParam('genre',  $genre, \PDO::PARAM_INT);
}
//associer les paramètres limit et offset aux valeurs
$clientSth->bindParam('limit', $limit, \PDO::PARAM_INT);
$clientSth->bindParam('offset', $offset, \PDO::PARAM_INT);
//on execute la requête
$clientSth->execute();


##### REQUETE PAGINATION
//requête pour récupérer le nombre de client en bdd
$requeteNbClients = "select count(*) as nbre from clients";
$requeteNbClients .= isset($recherche) ? $recherche : '';
$nbClientSth = $connexion->prepare($requeteNbClients);
if(null !== $search)
{
  $nbClientSth->bindValue(':search',  "%" . $search. "%");
}
if(null !== $genre)
{
    $nbClientSth->bindParam('genre',  $genre, \PDO::PARAM_INT);
}
//execute et récupère les résulats de la requête
$nbClientSth->execute();
//on récupère la première ligne du résultat (pas besoin de
//boucler car count ne retourne qu'une seule ligne)
$nbClient = $nbClientSth->fetch(PDO::FETCH_COLUMN);

//on compte le nombre de page
$nbPages = ceil($nbClient/$limit);


include('partials/header.php');

?>
<?php if(null !== $message): ?>
  <div class="alert alert-danger" role="alert">
  <?php echo $message; ?>
  </div>
<?php endif; ?>
<form action="client.php" method="GET" class="form-inline">
  <label class="sr-only" for="search">Nom/Prénom</label>
  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"
  name="search" id="search" placeholder="recherche nom/prénom"
  value="<?php echo $_GET['search'] ?? '' ?>"
  >
  <div class="form-check mb-2 mr-sm-2 mb-sm-0">
    <select class="form-control" id="genre" name="genre">
     <option value=''>-- genre --</option>
     <?php
     foreach($arrayGenre as $cle => $valeur)
     {
       $selected = $genre == $cle ? 'selected' : '';
       echo "<option $selected value='$cle'>$valeur</option>";
     }

     ?>
   </select>
  </div>
  <button type="submit" class="btn btn-primary">Rechercher</button>
</form>
<br>
<div class="text-right">
  <a href="client_edit.php">
    <button class="btn btn-primary">Ajouter un client</button>
  </a>
</div>
<br>
<?php

echo "<table class='table table-striped'>
        <thead class='thead-inverse'>
          <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Genre</th>
            <th>Date de naissance</th>
            <th>Action</th>
          </tr>
        </thead>
";

foreach($clientSth as $client)
{
  $g = isset($arrayGenre[$client['genre']]) ? $arrayGenre[$client['genre']] : 'N/D';
  echo   "<tr>
      <td>{$client['nom']}</td>
      <td>{$client['prenom']}</td>
      <td>$g</td>
      <td>{$client['date_de_naissance']}</td>
      <td>
        <a href='client_supprimer.php?id=".$client['id_client'] ."'>
          <button class='btn btn-danger'>Supprimer</button>
        </a>
        <button class='btn btn-primary'>Consulter</button>
      </td>
    </tr>";
}
echo "</table>";

echo "<nav aria-label='Page navigation example'>";
echo "<ul class='pagination'>";
if(1 != $page && count($page)> 1) {
  echo "<li class='page-item'><a class='page-link' href='client.php?page=".($page-1)."'>Previous</a></li>";
}

  for($i=1;$i<=$nbPages; $i++)
  {
    echo "<li class='page-item'><a class='page-link' href='client.php?page=$i'>$i</a></li>";
  }
if(20 != $page && count($page)> 1)
{
  echo "<li class='page-item'><a class='page-link' href='client.php?page=".($page+1)."'>Next</a></li>";
}
echo "</ul>";
echo "</nav>";

include('partials/footer.php');
