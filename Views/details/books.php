<?php
include '../../controller/connexion.php';
$id = $_GET['id'];
$i = 1;
$livres = $connexion->query("SELECT * FROM livre WHERE ID_LIVRE = $id");
$livres1 = $connexion->query("SELECT * FROM livre WHERE ID_LIVRE = $id");
$livres2 = $connexion->query("SELECT * FROM livre WHERE ID_LIVRE = $id");
$livres3 = $connexion->query("SELECT * FROM livre WHERE ID_LIVRE = $id");
$emprunt = $connexion->query("SELECT * FROM emprunter WHERE ID_LIVRE = $id AND RETOUNER = 1");
$emprunt0 = $connexion->query("SELECT * FROM emprunter WHERE ID_LIVRE = $id AND RETOUNER = 1");
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="../../Static/materialize/js/jquery-3.5.1.js"></script>
  <script src="../../Static/materialize/js/materialize.min.js"></script>
</head>

<body class="body">
  <!--Barre de navigation-->
  <nav class="my-nav-id white">
    <div class="nav-wrapper">
      <a href="../index.php" class="brand-logo left"><img src="../../Static/element/LOGO.png" class="my-logo-id" /></a>
    </div>
  </nav>
  <!--body de la page-->
  <section class="my-main">
    <h2>Détail</h2>
    <hr />
    <div class="my-container">
      <div class="row">
        <div class="col"></div>
        <div class="col l12 m12 s12 my-disposition centered">
          <!--Détails des etudiant-->
          <section class="my-detail-book">
            <?php while ($resultat = $livres3->fetch()) { ?>
              <img src="../../Static/res/livres/<?php echo $resultat['PHOTO']; ?>" alt="photo de profile" class="my-profile-pic" />
              <div class="my-buttons00">
                <a class="btn my-button" href="./modification/book.php?id=<?php echo $resultat['ID_LIVRE']; ?>">Modifier</a><br />
                <a class="btn my-button" href="../../controller/delete.php?id=<?php echo $resultat['ID_LIVRE']; ?>">Supprimer</a>
              </div>
              <div id="modal1" class="modal">
                <div class="modal-content">
                  <h4>Suppression de livre</h4>
                  <p>Voulez vous supprimer ce livre ?</p>
                </div>
                <div class="modal-footer">
                  <a href="../../controller/delete.php?id=<?php echo $resultat['ID_LIVRE']; ?>" class="waves-effect waves-green btn-flat">Oui</a>
                  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Non</a>
                </div>
              </div>
            <?php } ?>
            <div class="my-info">
              <?php while ($resultat = $livres->fetch()) { ?>
                <span class="my-title01">Titre du Livre: <span class="xyz"><?php echo $resultat['TITREL']; ?></span></span><br />
                <span class="my-title01">Nom de l'Auteur: <span class="xyz"><?php echo $resultat['AUTEURL']; ?></span></span><br />
                <span class="my-title01">Nombre de page : <span class="xyz"><?php echo $resultat['NPAGEL']; ?></span></span><br />
            </div>
            <div class="my-buttons">
              <a class="btn my-button" href="./modification/book.php?id=<?php echo $resultat['ID_LIVRE']; ?>">Modifier</a><br />
              <a class="btn my-button modal-trigger" href="#modal1">Supprimer</a>
            <?php } ?>
          </section>
          <h3 class="yz">Résumer des Exemplaires</h3>
          <section class="my-emprunt">
            <table class="my-table">
              <tr>
                <th>Nombre d'Exemplaire</th>
                <th>Nombre d'Emprunter</th>
                <th>Nombre de Présent</th>
              </tr>
              <?php while ($resultate = $livres1->fetch()) { ?>
                <tr>
                  <td><?php $x = intval($resultate['NBEMPRUNTER']);
                                                            $y = intval($resultate['NBEXEMPLAIRE']);
                                                            echo $x + $y; ?></td>
                  <td><?php echo $resultate['NBEMPRUNTER']; ?></td>
                  <td><?php echo $resultate['NBEXEMPLAIRE']; ?></td>
                </tr>
              <?php } ?>
            </table>
            <div class="card hoverable my-second-card00">
              <?php while ($resultate = $livres2->fetch()) { ?>
                <div class="card-content">
                  <span class="card-title">Résumer des Stats</span>
                  <p><span class="xy">Nombre d'Exemplaire : <?php $x = intval($resultate['NBEMPRUNTER']);
                                                            $y = intval($resultate['NBEXEMPLAIRE']);
                                                            echo $x + $y; ?></span></p>
                  <p><span class="xy">Nombre d'Emprunter : <?php echo $resultate['NBEMPRUNTER']; ?></span></p>
                  <p><span class="xy">Nombre de Présent : <?php echo $resultate['NBEXEMPLAIRE']; ?></span></p>
                </div>
              <?php } ?>

            </div>
            <h3>Résumer des Exemplaires Emprunter</h3>
            <table class="my-table">
              <tr>
                <th>N°</th>
                <th>Date d'Emprunt</th>
                <th>Date de Retour</th>
              </tr>
              <?php while ($resultat = $emprunt->fetch()) { ?>
                <tr>
                  <td><?php echo '#' . $i++; ?></td>
                  <td><?php echo $resultat['DATESORTIE']; ?></td>
                  <td><?php echo $resultat['DATERETOUR']; ?></td>
                </tr>
              <?php } ?>
            </table>
            <div class="my-second">
              <div class="card hoverable my-second-card">
                <?php while ($resultat = $emprunt0->fetch()) { ?>
                  <div class="card-content">
                    <span class="card-title"><?php echo '#' . $i++; ?></span>
                    <p><span class="xy">Date d'Emprunt : <?php echo $resultat['DATESORTIE']; ?></span></p>
                    <p><span class="xy">Date de Retour : <?php echo $resultat['DATERETOUR']; ?></span></p>
                  </div>
                <?php } ?>
              </div>
            </div>
          </section>
        </div>
        <div class="col"></div>
      </div>
    </div>
  </section>
  <section class="my-menu">
    <h3>Listes & Statistiques</h3>
    <ul class="my-liste">
      <li><a href="../index.php">Liste des Livres</a></li>
      <li><a href="../etudiants.php">Liste des Etudiants</a></li>
      <li><a href="../classes.php">Liste des Classes</a></li>
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
  </div>
  <footer class="my-foot-v">
    <p>
      Copyright &copy;
      <script>
        document.write(new Date().getFullYear());
      </script>
      Tous droits réservés
    </p>
  </footer>
 c
</body>

</html>