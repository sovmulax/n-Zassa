<?php
include '../../controller/connexion.php';
include '../../controller/search_books.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>N'Zassa | Tableau de Bord</title>
  <link rel="stylesheet" href="../../Static/css/style.css" />
  <link rel="stylesheet" href="../../Static/materialize/css/materialize.min.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="../../Static/materialize/js/jquery-3.5.1.js"></script>
  <script src="../../Static/materialize/js/materialize.min.js"></script>
</head>

<body class="body">
  <!--Barre de navigation-->
  <nav class="my-nav-id-02 white">
    <div class="nav-wrapper">
      <a href="../index.php" class="brand-logo left black-text">
        <div class="my-retour"><i class="fas fa-arrow-left"></i>Retour</div>
      </a>
    </div>
  </nav>
  <!--body de la page-->
  <section class="my-container">
    <h2>Recherche sur les Livres</h2>
    <!--Critère de recherche { titre, nom de l'auteur, nombre de page, date de retout, date d'emprunt } -->
    <hr />
    <div class="row">
      <div class="col"></div>
      <div class="col s12 center">
        <form method="post">
          <div class="input-field col l8 m8 s12">
            <input id="last_name" type="text" name="titre" class="validate" />
            <label for="last_name" class="black-text">Titre du Livre</label>
          </div>
          <div class="input-field col l4 m4 s12">
            <input id="last_name" type="number" name="page" class="validate" />
            <label for="last_name" class="black-text">Nombre de Page</label>
          </div>
          <div class="input-field col s12">
            <input id="last_name" type="text" name="auteur" class="validate" />
            <label for="last_name" class="black-text">Nom de L'auteur</label>
          </div>
          <div class="input-field col l6 m6 s12">
            <input id="last_name" type="date" name="dayEmprunt" class="validate" />
            <label for="last_name" class="black-text">Date d'emprunt</label>
          </div>
          <div class="input-field col l6 m6 s12">
            <input id="last_name" type="date" name="dayRetour" class="validate" />
            <label for="last_name" class="black-text">Date de Retour</label>
          </div>
          <input type="submit" name="livres" value="Rechercher" class="btn">
        </form>
        <hr />
        <div class="search">
          <?php foreach ($resultats as $resultat) { ?>
            <div class="search-div">
              <a href="../details/books.php?id=<?php echo $resultat['ID_LIVRE']; ?>" class="search-element"><?php echo $resultat['TITREL']; ?></a><br>
              <span class="my-par"><?php echo $resultat['AUTEURL']; ?></span>
            </div>
          <?php }
          echo $vide; ?>
        </div>
      </div>
      <div class="col"></div>
    </div>
  </section>
  <footer class="my-foot-v">
    <p>
      Copyright &copy;
      <script>
        document.write(new Date().getFullYear());
      </script>
      Tous droits réservés
    </p>
  </footer>
  <script>
    $(document).ready(function() {
      $("select").formSelect();
    });
  </script>
</body>

</html>