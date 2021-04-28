<?php
include '../../controller/connexion.php';
include '../../controller/student_search.php';

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
    <h2>Recherche sur Les Etudiants</h2>
    <hr />
    <div class="row">
      <div class="col"></div>
      <div class="col l12 m12 s12 center">
        <div class="container">
          <div class="row">
            <form method="POST">
              <div class="input-field col l6 m12 s12">
                <input id="nom_livre" type="search" name="nom" class="validate" />
                <label for="nom_livre" class="black-text">Nom de l'Etudiant</label>
              </div>
              <div class="input-field col l6 m12 s12">
                <select name="livre">
                  <option value="" disabled selected>
                    Choisissez le Livre Emprunter par l'Etudiant
                  </option>
                  <?php foreach ($resultatse as $resultat) { ?>
                    <option value="<?php echo $resultat['ID_LIVRE']; ?>"><?php echo $resultat['TITREL']; ?></option>
                  <?php } ?>
                </select>
                <label>Livres</label>
              </div>
              <div class="input-field col l6 m12 s12">
                <input id="nom_livre" type="search" name="matricule" class="validate" />
                <label for="nom_livre" class="black-text">Matricule de l'Etudiant</label>
              </div>
              <div class="input-field col l6 m12 s12">
                <select name="classe">
                  <option value="" disabled selected>
                    Choisissez la Classe de L'étudiant
                  </option>
                  <?php foreach ($results as $resultat) { ?>
                    <option value="<?php echo $resultat['ID_CLASSE']; ?>"><?php echo $resultat['LIBELLECL']; ?></option>
                  <?php } ?>
                </select>
                <label>Classe</label>
              </div>
              <div class="col s12">
                <input type="submit" value="Rechercher" name="etude" class="btn teal waves-effect waves-teal" />
              </div>
            </form>
          </div>
        </div>
        <hr />
        <div class="search">
          <?php foreach ($resultats as $resultat) { ?>
            <div class="search-div">
              <a href="../details/student.php?id=<?php echo $resultat['ID_ETUDIANT']; ?>" class="search-element"><?php echo $resultat['NOM'].' '.$resultat['PRENOM']; ?></a>
            </div>
          <?php } echo $vide; ?>
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
      $(".collapsible").collapsible();
      $("select").formSelect();
    });
  </script>
</body>

</html>