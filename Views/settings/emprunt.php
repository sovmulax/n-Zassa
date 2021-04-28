<?php
include '../../controller/connexion.php';
include '../../controller/retour.php';
include '../../controller/emprunt.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--meta http-equiv="refresh" content="1" /-->
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
      <a href="../index.php" class="brand-logo left black-text"><div class="my-retour"><i class="fas fa-arrow-left"></i>Retour</div></a>
    </div>
  </nav>
  <!--body de la page-->
  <section class="my-container">
    <h2>Gestion des Emprunts & Retours</h2>
    <hr />
    <br />
    <div class="row">
      <div class="col"></div>
      <div class="col l12 m12 s12">
        <section>
          <h3>Emprunt de Livre</h3>
          <hr />
          <br />
          <div class="container center">
            <div class="row">
              <form method="POST">
                <div class="input-field col l6 m12 s12">
                  <select name="titre">
                    <option value="" disabled selected>
                      Choisissez le livre à emprunter
                    </option>
                    <?php foreach ($resu as $res) { ?>
                      <option value="<?php echo $res['ID_LIVRE']; ?>"><?php echo $res['TITREL']; ?></option>
                    <?php } ?>
                  </select>
                  <label>Livre</label>
                  <span class="helper-text red-text"><?php echo $emprunt['titre']; ?></span>
                </div>
                <div class="input-field col l6 m12 s12">
                  <input id="nom_auteur" type="text" name="matricule" class="validate" />
                  <label for="nom_auteur" class="black-text">Matricule de L'Etudiant</label>
                  <span class="helper-text red-text"><?php echo $emprunt['matricule']; ?></span>
                </div>
                <input type="submit" value="Envoyer" name="submit00" class="btn teal waves-effect waves-teal" />
              </form>
            </div>
          </div>
        </section>
        <section>
          <h3>Retour de Livre</h3>
          <hr />
          <div class="container center">
            <div class="row">
              <form method="POST">
                <div class="input-field col s12">
                  <select name="retour">
                    <option value="" disabled selected>
                      Choisissez l'Exemplaire retourner
                    </option>
                    <?php foreach ($resultats as $resultatx) { ?>
                      <option value="<?php echo $resultatx['ID_LIVRE']; ?>"><?php echo $resultatx['TITREL']; ?></option>
                    <?php } ?>
                  </select>
                  <label>Exemplaire</label>
                  <span class="helper-text red-text"><?php echo $retourX; ?></span>
                </div>
                <input type="submit" value="Envoyer" name="submit01" class="btn teal waves-effect waves-teal" />
              </form>
            </div>
          </div>
        </section>
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