<?php session_start();
include '../../controller/connexion.php';
$id = $_GET['id'];
$_SESSION['id'] = $id;
$i = 1;
$livres = $connexion->query("SELECT * FROM etudiant WHERE ID_ETUDIANT = $id");
$livres1 = $connexion->query("SELECT * FROM etudiant WHERE ID_ETUDIANT = $id");
$emprunt = $connexion->query("SELECT * FROM emprunter WHERE ID_ETUDIANT = $id AND RETOUNER = 1");
$emprunt0 = $connexion->query("SELECT * FROM emprunter WHERE ID_ETUDIANT = $id AND RETOUNER = 1");
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
        <div class="col l12 m12 s12 my-disposition">
          <!--Détails des etudiant-->
          <section class="my-detail-book">
            <?php while ($resultat = $livres->fetch()) { ?>
              <img src="../../Static/res/etudiant/<?php echo $resultat['PHOTO']; ?>" alt="photo de profile" class="my-profile-pic" />
              <div id="modal1" class="modal">
                <div class="modal-content">
                  <h4>Suppression d'étudiant</h4>
                  <p>Voulez vous supprimer cet étudiant ?</p>
                </div>
                <div class="modal-footer">
                  <a class="btn my-button waves-effect waves-green btn-flat" href="../../controller/delete_student.php?id=<?php echo $resultat['ID_ETUDIANT']; ?>">oui</a>
                  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Non</a>
                </div>
              </div>
              <div class="my-buttons00">
                <a class="btn my-button" href="./modification/etudiant.php?id=<?php echo $resultat['ID_ETUDIANT']; ?>">Modifier</a><br />
                <a class="btn my-button modal-trigger" href="#modal1">Supprimer</a>
              </div>
            <?php } ?>
            <div class="my-info">
              <?php while ($resultat = $livres1->fetch()) { ?>
                <span class="my-title01">Nom : <span class="xyz"><?php echo $resultat['NOM']; ?></span></span><br />
                <span class="my-title01">Prénom : <span class="xyz"><?php echo $resultat['PRENOM']; ?></span></span><br />
                <span class="my-title01">Adresse : <span class="xyz"><?php echo $resultat['ADRESSE']; ?></span></span><br />

            </div>
            <div class="my-buttons">
              <a class="btn my-button" href="./modification/etudiant.php?id=<?php echo $resultat['ID_ETUDIANT']; ?>">Modifier</a><br />
              <a class="btn my-button modal-trigger" href="#modal1">Supprimer</a>
            </div>
          <?php } ?>
          </section>
          <h3>Résumé des Emprunts</h3>
          <section class="my-emprunt center">
            <table class="my-table">
              <tr>
                <th>N°</th>
                <th>Nom du Livre</th>
                <th>Date d'Emprunt</th>
                <th>Date de Retour</th>
              </tr>
              <?php while ($resultat = $emprunt->fetch()) { ?>
                <tr>
                  <td><?php echo '#' . $i++; ?></td>
                  <td><?php $req = $connexion->prepare('SELECT * FROM livre WHERE ID_LIVRE = :photo');
                      $req->execute(['photo' => $resultat['ID_LIVRE']]);
                      $res = $req->fetch();
                      echo $res['TITREL']; ?></td>
                  <td><?php echo $resultat['DATESORTIE']; ?></td>
                  <td><?php echo $resultat['DATERETOUR']; ?></td>
                </tr>
              <?php } ?>
            </table>
            <img src="../../controller/graphe.php" alt="">
            <div class="my-second">
              <?php while ($resultat = $emprunt0->fetch()) { ?>
                <div class="card hoverable my-second-card">

                  <div class="card-content">
                    <span class="card-title"><?php $req = $connexion->prepare('SELECT * FROM livre WHERE ID_LIVRE = :photo');
                                              $req->execute(['photo' => $resultat['ID_LIVRE']]);
                                              $res = $req->fetch();
                                              echo $res['TITREL']; ?></span>
                    <p><span class="xy">Date d'Emprunt : <?php echo $resultat['DATESORTIE']; ?></span></p>
                    <p><span class="xy">Date de Retour : <?php echo $resultat['DATERETOUR']; ?></span></p>
                  </div>
                </div>
              <?php } ?>
            </div>
            <h3>Graphique Statistiques des emprunts de l'Etudiant</h3>
            <div id="chart-container">
              <canvas id="mycanvas"></canvas>
            </div>
            <!-- javascript -->
            <script type="text/javascript" src="./chartjs/js/jquery.min.js"></script>
            <script type="text/javascript" src="./chartjs/js/Chart.min.js"></script>
            <script type="text/javascript" src="./chartjs/js/app.js"></script>
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
      $('.modal').modal();
    });
  </script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../Static/materialize/js/jquery-3.5.1.js"></script>
<script src="../Static/materialize/js/materialize.min.js"></script>

</html>