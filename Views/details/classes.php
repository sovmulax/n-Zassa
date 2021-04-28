<?php
include '../../controller/connexion.php';
$id = $_GET['id'];
$i = 1;
$emprunt = $connexion->query("SELECT * FROM etudiant WHERE ID_CLASSE = $id");
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
          <section class="my-emprunt center">
            <h3>Résumer des Emprunts</h3>
            <table class="my-table">
              <tr>
                <th>N°</th>
                <th>Nom de L'Etudiant</th>
                <th>Livre Emprunter</th>
              </tr>
              <?php while ($resultat = $emprunt->fetch()) { ?>
                <tr class="classe">
                  <td><?php echo '#' . $i++; ?></td>
                  <?php $etu = $resultat['ID_ETUDIANT'];
                  $emprunt0 = $connexion->query("SELECT * FROM etudiant WHERE ID_ETUDIANT = $etu AND ID_CLASSE = $id");
                  while ($resultat0 = $emprunt0->fetch()) {
                  ?>
                    <td><?php echo $resultat0['NOM'] . ' ' . $resultat0['PRENOM']; ?></td>
                    <?php $tt = $resultat0['ID_ETUDIANT'];
                    $req = $connexion->query("SELECT ID_LIVRE FROM emprunter WHERE ID_ETUDIANT = $tt");
                    while ($resultat1 = $req->fetch()) {
                    ?>
                      <td><?php $req = $connexion->prepare('SELECT * FROM livre WHERE ID_LIVRE = :photo');
                          $req->execute(['photo' => $resultat1['ID_LIVRE']]);
                          $res = $req->fetch();
                          echo $res['TITREL']; ?></td>
                    <?php } ?>
                </tr>
              <?php } ?>
            <?php } ?>
            </table>
            <div id="modal1" class="modal">
              <div class="modal-content">
                <h4>Suppression de classe</h4>
                <p>Voulez vous supprimer cette classe ?</p>
              </div>
              <div class="modal-footer">
                <a href="../../controller/delete_classe.php?id=<?php echo $id ?>" class="waves-effect waves-green btn-flat">Oui</a>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Non</a>
              </div>
            </div>
            <a class="btn my-button modal-trigger" href="#modal1">Supprimer</a>
            <div class="my-second">
              <div class="card hoverable my-second-card">
                <div class="card-content">
                  <span class="card-title">#1</span>
                  <p><span class="xy">Date d'Emprunt :</span></p>
                  <p><span class="xy">Date de Retour :</span></p>
                </div>
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

</html>