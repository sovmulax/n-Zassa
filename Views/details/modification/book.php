<?php include '../../../controller/connexion.php';
include "../../../controller/update_livre.php";
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>N'Zassa | Tableau de Bord</title>
    <link rel="stylesheet" href="../../../Static/css/style.css" />
    <link rel="stylesheet" href="../../../Static/materialize/css/materialize.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../../../Static/materialize/js/jquery-3.5.1.js"></script>
    <script src="../../../Static/materialize/js/materialize.min.js"></script>
</head>

<body class="body">
    <!--Barre de navigation-->
    <nav class="my-nav-id-02 white">
        <div class="nav-wrapper">
            <a href="../books.php?id=<?php echo $id; ?>" class="brand-logo left black-text"><div class="my-retour"><i class="fas fa-arrow-left"></i>Retour</div></a>
        </div>
    </nav>
    <!--body de la page-->
    <section class="my-container">
        <h2>Modification d'information</h2>
        <hr />
        <div class="row">
            <div class="col"></div>
            <div class="col l12 m12 s12 center">
                <div class="container">
                    <div class="row">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="input-field col l6 m12 s12">
                                <input id="nom_livre" name="titre" value="<?php echo $resultats['TITREL']; ?>" type="text" class="validate" />
                                <label for="nom_livre" class="black-text">Nom du Livre</label>
                                <span class="helper-text red-text"><?php echo $livres['titre']; ?></span>
                            </div>
                            <div class="input-field col l6 m12 s12">
                                <input id="nom_auteur" name="nom" value="<?php echo $resultats['AUTEURL']; ?>" type="text" class="validate" />
                                <label for="nom_auteur" class="black-text">Nom de L'Auteur</label>
                                <span class="helper-text red-text"><?php echo $livres['nom']; ?></span>
                            </div>
                            <div class="input-field col l6 m12 s12">
                                <input id="genre" name="genre" value="<?php echo $resultats['GENREL']; ?>" type="text" class="validate" />
                                <label for="genre" class="black-text">Genre Littéraire</label>
                                <span class="helper-text red-text"><?php echo $livres['genre']; ?></span>
                            </div>
                            <div class="input-field col l6 m12 s12">
                                <input id="nombre" name="nbPage" value="<?php echo $resultats['NPAGEL']; ?>" type="number" class="validate" />
                                <label for="nombre" class="black-text">Nombre de Page</label>
                                <span class="helper-text red-text"><?php echo $livres['nbPage']; ?></span>
                            </div>
                            <div class="input-field col s12">
                                <textarea id="textarea1" class="materialize-textarea" name="description" value="<?php echo $resultats['DESCRIPTION']; ?>"><?php echo $resultats['DESCRIPTION']; ?></textarea>
                                <label for="textarea1" class="black-text">Description</label>
                                <span class="helper-text red-text"><?php echo $livres['description']; ?></span>
                            </div>
                            <input type="submit" value="Envoyer" name="submit00" class="btn teal waves-effect waves-teal" />
                        </form>
                    </div>
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