<?php
include('connect.php');
// on crée un tableau contenant la liste des genres (clé => valeur)
$genre = [
  1 => 'femme',
  2 => 'homme',
  3 => 'autre'
];
//Vérifie si la propriété page existe, si elle existe on la renvoie
// en convertisant le resultat en int sinon on retourne la page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//coalesce en php, on prend la premiere valeur si elle existe
//et si elle est différente de null sinon on renvoie la valeur
// suivante. Ce code fait la même chose que celui du dessus.
//$page = $_GET['page'] ?? 1;

$nom = $_GET['nom'] ?? null;
$prenom = $_GET['prenom'] ?? null;


//requête pour récupérer le nombre de client en bdd
$requeteNbClients = "select count(*) as nbre from clients";
//execute et récupère les résulats de la requête
$resultatNbClients = $connexion->query($requeteNbClients);
//on récupère la première ligne du résultat (pas besoin de boucler car count ne retourne qu'une seule
//ligne)
$nbClient = $resultatNbClients->fetch(PDO::FETCH_COLUMN);

//initialisation des variables pour la pagination
// limit : la quantité d'enregistrements qu'on va afficher par page
// offset : décalage
$limit = 5;

//décalage
$offset = ($page-1)*$limit ;

//on compte le nombre de page
$nbPages = ceil($nbClient/$limit);

//requête pour récupérer les clients
$requeteClient = "select * from clients";
/**
if(null !== $nom) {
    $requeteClient .= " where nom like '%$nom%' ";
}
if(null !== $prenom) {
  $requeteClient .= " and prenom like '%$prenom%' ";
}
*/
$requeteClient .= " limit $limit offset $offset";

//on execute et récupère les résultats de la requête
$clients = $connexion->query($requeteClient);

include('partials/header.php');
?>
<form action="client.php" method="POST">
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" name="recherche[nom]" class="form-control" id="nom" placeholder="recherche nom">
  </div>
  <div class="form-group">
    <label for="prenom">Prénom</label>
    <input type="text" name="recherche[prenom]" class="form-control" id="prenom" placeholder="recherche prenom">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


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

foreach($clients as $client)
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
