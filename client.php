<?php
include('connect.php');

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
$offset = 0;

//on compte le nombre de page
$nbPages = ceil($nbClient/$limit);

//requête pour récupérer les clients
$requeteClient = "select * from clients limit $limit offset $offset";

//on execute et récupère les résultats de la requête
$clients = $connexion->query($requeteClient);

include('partials/header.php');

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
  echo   "<tr>
      <td>{$client['nom']}</td>
      <td>{$client['prenom']}</td>
      <td>{$client['genre']}</td>
      <td>{$client['date_de_naissance']}</td>
    </tr>";
}


echo "</table>";

echo "<nav aria-label='Page navigation example'>";
echo "<ul class='pagination'>";
echo "<li class='page-item'><a class='page-link' href='#'>Previous</a></li>";
  for($i=1;$i<=$nbPages; $i++)
  {
    echo "<li class='page-item'><a class='page-link' href='client.php?page=$i'>$i</a></li>";
  }
echo "<li class='page-item'><a class='page-link' href='#'>Next</a></li>";
echo "</ul>";
echo "</nav>";

include('partials/footer.php');
