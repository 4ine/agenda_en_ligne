<?php
include('connect.php');
// on crée un tableau contenant la liste des genres (clé => valeur)
$genre = [
  1 => 'femme',
  2 => 'homme',
  3 => 'autre'
];

//Vérifie si la propriété page existe, si elle existe on la renvoie
//en convertissant le resultat en int sinon on retourne la page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$search = !empty($_GET['search']) ? $_GET['search'] : null;

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
if(null !== $search)
{
  $recherche = " where nom like :search or prenom like :search ";
  $requeteClient .= $recherche;
}
$requeteClient .= " limit :limit offset :offset";

//preparation d'une requête (on récupère un object PDOStatement)
$clientSth = $connexion->prepare($requeteClient);
if(null !== $search)
{
  $clientSth->bindValue(':search',  "%" . $search. "%");
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
//execute et récupère les résulats de la requête
$nbClientSth->execute();
//on récupère la première ligne du résultat (pas besoin de
//boucler car count ne retourne qu'une seule ligne)
$nbClient = $nbClientSth->fetch(PDO::FETCH_COLUMN);

//on compte le nombre de page
$nbPages = ceil($nbClient/$limit);


include('partials/header.php');
?>
<form action="client.php" method="GET" class="form-inline">
  <label class="sr-only" for="search">Nom/Prénom</label>
  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"
  name="search" id="search" placeholder="recherche nom/prénom">
  <div class="form-check mb-2 mr-sm-2 mb-sm-0">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox"> Remember me
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Rechercher</button>
</form>
<br />
<?php

echo "<table class='table table-striped'>
        <thead class='thead-inverse'>
          <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Genre</th>
            <th>Date de naissance</th>
          </tr>
        </thead>
";

foreach($clientSth as $client)
{
  $g = isset($genre[$client['genre']]) ? $genre[$client['genre']] : 'N/D';
  echo   "<tr>
      <td>{$client['nom']}</td>
      <td>{$client['prenom']}</td>
      <td>$g</td>
      <td>{$client['date_de_naissance']}</td>
    </tr>";
}
echo "</table>";

echo "<nav aria-label='Page navigation example'>";
echo "<ul class='pagination'>";
if(1 != $page) {
  echo "<li class='page-item'><a class='page-link' href='client.php?page=".($page-1)."'>Previous</a></li>";
}

  for($i=1;$i<=$nbPages; $i++)
  {
    echo "<li class='page-item'><a class='page-link' href='client.php?page=$i'>$i</a></li>";
  }
if(20 != $page)
{
  echo "<li class='page-item'><a class='page-link' href='client.php?page=".($page+1)."'>Next</a></li>";
}
echo "</ul>";
echo "</nav>";

include('partials/footer.php');
