<?php session_start();
 include '../../../controller/connexion.php';
$sql0 = "SELECT * FROM classe";
$result = mysqli_query($conn, $sql0);
$resultate = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
$id = $_GET['id'];

$req = $connexion->prepare("SELECT * FROM etudiant WHERE ID_ETUDIANT = :id");
$req->execute(['id' => $id]);
$resultats = $req->fetch();

$etudiant = array("nom" => '', "prenom" => '', "matricule" => '', "classe" => '', "adresse" => '');
if (isset($_POST['submit'])) {

    //check nom
    if (empty($_POST['nom'])) {
        $etudiant['nom'] = "Entrez un nom";
    } else {
        $nom = htmlspecialchars($_POST['nom']);
        if (!preg_match('/^([a-zA-Zéèàâê\s]+)(\s*[a-zA-Zéèàâê\s]*)*$/', $nom)) {
            $etudiant['nom'] = "le nom entré n'est pas valide";
        } else {
            $prenom = htmlspecialchars($_POST['prenom']);
        }
    }

    //check prenom
    if (empty($_POST['prenom'])) {
        $etudiant['prenom'] = "Entrez un prenom";
    } else {
        $prenom = htmlspecialchars($_POST['prenom']);
        if (!preg_match('/^([a-zA-Zéèàâê\s]+)(\s*[a-zA-Zéèàâê\s]*)*$/', $prenom)) {
            $etudiant['prenom'] = "le prenom entré n'est pas valide";
        } else {
            $prenom = htmlspecialchars($_POST['prenom']);
        }
    }

    //check adresse
    if (empty($_POST['adresse'])) {
        $etudiant['adresse'] = "Entrée une adresse";
    } else {
        $adresse = htmlspecialchars($_POST['adresse']);
        if (!preg_match('/^([a-zA-Zéèàâê\s]+)(,\s*[a-zA-Zéèàâê\s]*)*$/', $adresse)) {
            $etudiant['adresse'] = "l'adresse entré n'est pas valide";
        } else {
            $adresse = htmlspecialchars($_POST['adresse']);
        }
    }

    //check classe
    if (empty($_POST['classe'])) {
        $etudiant['classe'] = "Sélectionnez une classe";
    } else {
        $classe = $_POST['classe'];
    }

    //check matricule
    if (empty($_POST['matricule'])) {
        $etudiant['matricule'] = "Ecrivez un matricule";
    } else {
        $matricule = $_POST['matricule'];
    }

    //envoie de donner
    if (array_filter($etudiant)) {
        //rien du tous
    } else {
        //requete sql
        $sql = "UPDATE etudiant SET ID_CLASSE = '$classe', MATRICULE = '$matricule', NOM = '$nom', PRENOM = '$prenom', ADRESSE = '$adresse' WHERE ID_ETUDIANT = '$id'";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            if ($classe != $resultats['ID_CLASSE']) {
                $res = $connexion->query("SELECT * FROM classe WHERE ID_CLASSE = $classe");
                while ($nbe = $res->fetch()) {
                    $j = $nbe['NBINSCRIT'];
                }
                $i = intval($j) + 1;

                $sqle = "UPDATE classe SET NBINSCRIT = $i WHERE ID_CLASSE = $classe";
                // save to db and check
                if (mysqli_query($conn, $sqle)) {
                    //rien
                    $nx = $resultats['ID_CLASSE'];
                    $res = $connexion->query("SELECT * FROM classe WHERE ID_CLASSE = $nx");
                    while ($nbe = $res->fetch()) {
                        $j = $nbe['NBINSCRIT'];
                    }
                    $i = intval($j) - 1;

                    $sqleS = "UPDATE classe SET NBINSCRIT = $i WHERE ID_CLASSE = $nx";
                    // save to db and check
                    if (mysqli_query($conn, $sqleS)) {
                        //rien
                    } else {
                        echo 'query error: ' . mysqli_error($conn);
                    }
                } else {
                    echo 'query error: ' . mysqli_error($conn);
                }
            }
            echo "<script>alert('Etudiant Ajouter avec Succès')</script>";
            header("Location: ../student.php?id=$id");
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}

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
            <a href="../student.php?id=<?php echo $id; ?>" class="brand-logo left black-text">
                <div class="my-retour"><i class="fas fa-arrow-left"></i>Retour</div>
            </a>
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
                                <input id="nom" type="text" name="nom" value="<?php echo $resultats['NOM']; ?>" class="validate" />
                                <label for="nom" class="black-text">Nom </label>
                                <span class="helper-text red-text"><?php echo $etudiant['nom'];?></span>
                            </div>
                            <div class="input-field col l6 m12 s12">
                                <input id="prenom" type="text" name="prenom" value="<?php echo $resultats['PRENOM']; ?>" class="validate" />
                                <label for="prenom" class="black-text">Prénom</label>
                                <span class="helper-text red-text"><?php echo $etudiant['prenom']; ?></span>
                            </div>
                            <div class="input-field col l6 m12 s12">
                                <input id="matricule" type="text" name="matricule" value="<?php echo $resultats['MATRICULE']; ?>" class="validate" />
                                <label for="matricule" class="black-text">Matricule</label>
                                <span class="helper-text red-text"><?php echo $etudiant['matricule']; ?></span>
                            </div>
                            <div class="input-field col l6 m12 s12">
                                <select name="classe">
                                    <option value="" disabled selected>
                                        Choisissez une Classe
                                    </option>
                                    <?php foreach ($resultate as $resultat) { ?>
                                        <option value="<?php echo $resultat['ID_CLASSE']; ?>"><?php echo $resultat['LIBELLECL']; ?></option>
                                    <?php } ?>
                                </select>
                                <label>Classes</label>
                                <span class="helper-text red-text"><?php echo $etudiant['classe']; ?></span>
                            </div>
                            <div class="input-field col s12">
                                <input placeholder="Abidjan, koumassi" id="first_name" name="adresse" value="<?php echo $resultats['ADRESSE']; ?>" type="text" class="validate" />
                                <label for="first_name" class="black-text">Adresse</label>
                                <span class="helper-text red-text"><?php echo $etudiant['adresse']; ?></span>
                            </div>
                            <input type="submit" value="Envoyer" name="submit" class="btn teal waves-effect waves-teal" />
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