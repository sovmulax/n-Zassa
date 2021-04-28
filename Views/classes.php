<?php
include '../controller/connexion.php';
$sql = "SELECT * FROM classe";
$result = mysqli_query($conn, $sql);
$resultats = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>N'Zassa | Tableau de Bord</title>
  <link rel="stylesheet" href="../Static/css/style.css" />
  <link rel="stylesheet" href="../Static/materialize/css/materialize.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="../Static/materialize/js/jquery-3.5.1.js"></script>
  <script src="../Static/materialize/js/materialize.min.js"></script>
</head>

<body class="body">
  <!--Barre de navigation-->
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="./search/etudiant.php">Etudiant</a></li>
    <li><a href="./search/livres.php">Livres</a></li>
  </ul>
  <nav class="my-nav-id white">
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo left"><img src="../Static/element/LOGO.png" class="my-logo-id" /></a>
      <ul class="right my">
        <li>
          <a class="dropdown-trigger waves-effect m1 waves-teal black-text" href="#!" data-target="dropdown1">Recherche Avancé</a>
        </li>
        <li>
          <a href="./settings/emprunt.php" class="waves-effect m1 waves-teal black-text">Emprunt</a>
        </li>
        <li>
          <a href="./settings/Paramètre.php" class="waves-effect m1 waves-teal black-text">Paramètre</a>
        </li>
      </ul>
      <ul id="nav-mobile" class="right hide-on-med-and-down"></ul>
    </div>
  </nav>
  <!--body de la page-->
  <section class="my-main">
    <h2>Liste des Classes</h2>
    <hr />

    <div class="my-container">
      <div class="row">
        <div class="col"></div>
        <div class="col l12 m12 s12">
          <div class="col l12 m12 s12">
            <div class="container">
              <div class="input-field col s12">
                <input id="idsearch" type="text" class="validate" />
                <label for="last_name" class="black-text">Rechercher</label>
              </div>
            </div>
          </div>
          <table class="centered my-table">
            <tbody id="clients">
              <?php foreach ($resultats as $resultat) { ?>
                <tr class="classe">
                  <td><?php echo $resultat['LIBELLECL'] ?></td>
                  <td><?php echo $resultat['NBINSCRIT'] ?> <span class="my-par">inscrit(s)</span></td>
                  <td class="my-par">
                    <a href="./details/classes.php?id=<?php echo $resultat['ID_CLASSE'] ?>">plus...</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="col"></div>
      </div>
    </div>
  </section>
  <section class="my-menu">
    <h3>Listes & Statistiques</h3>
    <ul class="my-liste">
      <li><a href="index.php">Liste des Livres</a></li>
      <li><a href="etudiants.php">Liste des Etudiants</a></li>
      <li><a href="classes.php">Liste des Classes</a></li>
    </ul>

    <h4>Stats</h4>
    <ul class="my-liste">
      <li>Nombre de livre : <?php $res = $connexion->query('SELECT * FROM livre');
                            $i = 0;

                            while ($k = $res->fetch()) {
                              $i++;
                            }
                            echo $i;
                            ?></li>
      <li>Nombre D'Etudiant : <?php $res = $connexion->query('SELECT * FROM etudiant');
                              $i = 0;

                              while ($k = $res->fetch()) {
                                $i++;
                              }
                              echo $i;
                              ?></li>
      <li>Nombre de Classe : <?php $res = $connexion->query('SELECT * FROM classe');
                              $i = 0;

                              while ($k = $res->fetch()) {
                                $i++;
                              }
                              echo $i;
                              ?></li>
      <li>Nombre d'emprunt en cour : <?php $res = $connexion->query('SELECT * FROM emprunter WHERE RETOUNER = 1');
                              $i = 0;

                              while ($k = $res->fetch()) {
                                $i++;
                              }
                              echo $i;
                              ?></li>
    </ul>
  </section>
  <!-------------------------->
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
      $(".dropdown-trigger").dropdown();
    });
    $(document).ready(function() {
      $("#idsearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#clients .classe").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
  </script>
</body>

</html>