<?php include '../../controller/connexion.php';
include '../../controller/ajout_livre.php';
include '../../controller/ajout_etudiant.php';
include '../../controller/ajout_classe.php';
include '../../controller/ajout_exemplaire.php';
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
      <a href="../index.php" class="brand-logo left black-text"><div class="my-retour"><i class="fas fa-arrow-left"></i>Retour</div></a>
    </div>
  </nav>
  <!--body de la page-->
  <section class="my-container">
    <h2>Paramétrage</h2>
    <hr />
    <div class="row">
      <div class="col"></div>
      <div class="col l12 m12 s12 center">
        <ul class="collapsible">
          <li>
            <div class="collapsible-header">
              <i class=""></i>Ajout De Livre
            </div>
            <div class="collapsible-body">
              <div class="container">
                <div class="row">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="file-field input-field col s12">
                      <div class="btn">
                        <span>Selectionnez une Photo</span>
                        <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg" />
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" />
                      </div>
                      <span class="helper-text red-text"><?php echo $etudiant['photo']; ?></span>
                    </div>
                    <div class="input-field col l6 m12 s12">
                      <input id="nom_livre" name="titre" type="text" class="validate" />
                      <label for="nom_livre" class="black-text">Nom du Livre</label>
                      <span class="helper-text red-text"><?php echo $livres['titre']; ?></span>
                    </div>
                    <div class="input-field col l6 m12 s12">
                      <input id="nom_auteur" name="nom" type="text" class="validate" />
                      <label for="nom_auteur" class="black-text">Nom de L'Auteur</label>
                      <span class="helper-text red-text"><?php echo $livres['nom']; ?></span>
                    </div>
                    <div class="input-field col l6 m12 s12">
                      <input id="genre" name="genre" type="text" class="validate" />
                      <label for="genre" class="black-text">Genre Littéraire</label>
                      <span class="helper-text red-text"><?php echo $livres['genre']; ?></span>
                    </div>
                    <div class="input-field col l6 m12 s12">
                      <input id="nombre" name="nbPage" type="number" class="validate" />
                      <label for="nombre" class="black-text">Nombre de Page</label>
                      <span class="helper-text red-text"><?php echo $livres['nbPage']; ?></span>
                    </div>
                    <div class="input-field col s12">
                      <textarea id="textarea1" class="materialize-textarea" name="description"></textarea>
                      <label for="textarea1" class="black-text">Description</label>
                      <span class="helper-text red-text"><?php echo $livres['description']; ?></span>
                    </div>
                    <input type="submit" value="Envoyer" name="submit00" class="btn teal waves-effect waves-teal" />
                  </form>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header">
              <i class=""></i>Ajout d'Etudiant
            </div>
            <div class="collapsible-body">
              <div class="container">
                <div class="row">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="file-field input-field col s12">
                      <div class="btn">
                        <span>Selectionnez une Photo</span>
                        <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg" />
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" />
                      </div>
                      <span class="helper-text red-text"><?php echo $etudiant['photo']; ?></span>
                    </div>
                    <div class="input-field col l6 m12 s12">
                      <input id="nom" type="text" name="nom" class="validate" />
                      <label for="nom" class="black-text">Nom</label>
                      <span class="helper-text red-text"><?php echo $etudiant['nom']; ?></span>
                    </div>
                    <div class="input-field col l6 m12 s12">
                      <input id="prenom" type="text" name="prenom" class="validate" />
                      <label for="prenom" class="black-text">Prénom</label>
                      <span class="helper-text red-text"><?php echo $etudiant['prenom']; ?></span>
                    </div>
                    <div class="input-field col l6 m12 s12">
                      <input id="matricule" type="text" name="matricule" class="validate" />
                      <label for="matricule" class="black-text">Matricule</label>
                      <span class="helper-text red-text"><?php echo $etudiant['matricule']; ?></span>
                    </div>
                    <div class="input-field col l6 m12 s12">
                      <select name="classe">
                        <option value="" disabled selected>
                          Choisissez une Classe
                        </option>
                        <?php foreach ($resultats as $resultat) { ?>
                          <option value="<?php echo $resultat['ID_CLASSE']; ?>"><?php echo $resultat['LIBELLECL']; ?></option>
                        <?php } ?>
                      </select>
                      <label>Classes</label>
                      <span class="helper-text red-text"><?php echo $etudiant['classe']; ?></span>
                    </div>
                    <div class="input-field col s12">
                      <input placeholder="Abidjan, koumassi" id="first_name" name="adresse" type="text" class="validate" />
                      <label for="first_name" class="black-text">Adresse</label>
                      <span class="helper-text red-text"><?php echo $etudiant['adresse']; ?></span>
                    </div>
                    <input type="submit" value="Envoyer" name="submit02" class="btn teal waves-effect waves-teal" />
                  </form>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header">
              <i class=""></i>Ajout de Classe
            </div>
            <div class="collapsible-body">
              <div class="container">
                <div class="row">
                  <form method="POST">
                    <div class="input-field col s12">
                      <input id="nom" type="text" name="classe" class="validate" />
                      <label for="nom" class="black-text">Intitulé de la Classe</label>
                      <span class="helper-text red-text"><?php echo $classe; ?></span>
                    </div>
                    <input type="submit" value="Envoyer" name="submit01" class="btn teal waves-effect waves-teal" />
                  </form>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header">
              <i class=""></i>Créé des Exemplaires
            </div>
            <div class="collapsible-body">
              <div class="container">
                <div class="row">
                  <form method="POST">
                    <div class="input-field col l6 m12 s12">
                      <select name="titre">
                        <option value="" disabled selected>
                          Choisissez le Livre
                        </option>
                        <?php foreach ($res as $resultatx) { ?>
                          <option value="<?php echo $resultatx['ID_LIVRE']; ?>"><?php echo $resultatx['TITREL']; ?></option>
                        <?php } ?>
                      </select>
                      <label>Livres</label>
                      <span class="helper-text red-text"><?php echo $exemplaire['titre']; ?></span>
                    </div>
                    <div class="input-field col l6 m12 s12">
                      <input id="nom_livre" name="nbex" type="text" class="validate" />
                      <label for="nom_livre" class="black-text">Nombre d'Exemplaire</label>
                      <span class="helper-text red-text"><?php echo $exemplaire['nbex']; ?></span>
                    </div>
                    <input type="submit" value="Envoyer" name="submit03" class="btn teal waves-effect waves-teal" />
                  </form>
                </div>
              </div>
            </div>
          </li>
        </ul>
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