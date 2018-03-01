<?php
session_start();
include('connect.php');
if($_POST){

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
      <input class="form-control" type="text" name="genre" value="" id="genre">
    </div>
  </div>

  <div class="form-group row">
    <label for="date_de_naissance" class="col-2 col-form-label">Date de naissance</label>
    <div class="col-10">
      <input class="form-control" type="text" name="date_de_naissance" value="" id="date_de_naissance">
    </div>
  </div>
  <div class="form-group row">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
  </div>
</form>
<?php

include('partials/footer.php');
