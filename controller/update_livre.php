<?php
$id = $_GET['id'];
$req = $connexion->prepare('SELECT * FROM livre WHERE ID_LIVRE = :id');
$req->execute(['id' => $id]);
$resultats = $req->fetch();

$livres = array("titre" => '', "nom" => '', "nbPage" => '', "description" => '', "genre" => '');

if (isset($_POST['submit00'])) {

    //check titre
    if (empty($_POST['titre'])) {
        $livres['titre'] = "Entrez un titre";
    } else {
        $titre = htmlspecialchars($_POST['titre']);
        if (!preg_match('/^([a-zA-Zéèàê\s]+)(\s*[a-zA-Zéèàê\s]*)*$/', $titre)) {
            $livres['titre'] = "le titre entré n'est pas valide";
        }
    }

    //check nom
    if (empty($_POST['nom'])) {
        $livres['nom'] = "Entrée un nom";
    } else {
        $nom = htmlspecialchars($_POST['nom']);
        if (!preg_match('/^([a-zA-Zéèàâê\s]+)(\s*[a-zA-Zéèâàê\s]*)*$/', $nom)) {
            $livres['nom'] = "le nom entré n'est pas valide";
        }
    }

    //check genre
    if (empty($_POST['genre'])) {
        $livres['genre'] = "Entrée un genre";
    } else {
        $genre = htmlspecialchars($_POST['genre']);
        if (!preg_match('/^([a-zA-Zéèàê\s]+)(,\s*[a-zA-Zéèàê\s]*)*$/', $genre)) {
            $livres['genre'] = "le genre entré n'est pas valide";
        }
    }

    //check nombre de page
    if ($_POST['nbPage'] < 0) {
        $livres['nbPage'] = "le nombre de page n'est pas valide";
    } else {
        $nbPage = htmlspecialchars($_POST['nbPage']);
    }

    //check description
    if (empty($_POST['description'])) {
        $errors = "Ecrivez une description";
    } else {
        $description = $_POST['description'];
    }

    //envoie de donner
    if (array_filter($livres)) {
        //rien du tous
    } else {
        //securité des donners
        $titre = mysqli_real_escape_string($conn, $_POST['titre']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $nbPage = mysqli_real_escape_string($conn, $_POST['nbPage']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        
        //requete sql
        /*$sql = $connexion->query("UPDATE livre SET TITREL = '$titre', AUTEURL = '$nom', GENREL = '$genre', NPAGEL = '$nbPage', DESCRIPTION = '$description' WHERE ID_LIVRE = '$id'");
        $sql->fetch();*/
        // save to db and check
        //requete sql
        $sql = "UPDATE livre SET TITREL = '$titre', AUTEURL = '$nom', GENREL = '$genre', NPAGEL = '$nbPage', DESCRIPTION = '$description' WHERE ID_LIVRE = '$id'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Modification éffectuer avec Succès')</script>";
            header("Location: ../books.php?id=$id");
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}