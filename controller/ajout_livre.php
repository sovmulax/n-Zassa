<?php
$livres = array("photo" => '', "titre" => '', "nom" => '', "nbPage" => '', "description" => '', "genre" => '');

if (isset($_POST['submit00'])) {

    //check photo
    if (isset($_FILES['photo']) and $_FILES['photo']['error'] == 0) {
        // Testons si le fichier n'est pas trop lourd
        if ($_FILES['photo']['size'] <= 1000000) {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['photo']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'png');
            if (in_array($extension_upload, $extensions_autorisees)) {
                $envoie = true;
            } else {
                $envoie = false;
            }
        } else {
            $livres['photo'] = 'Erreur de fichier';
        }
    } else {
        $livres['photo'] = 'selectionnez une photo';
    }

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
        $res = $connexion->query("SELECT * FROM livre");
        while($nbe = $res->fetch()){
            $j = $nbe['ID_LIVRE'];
        }
        $i = intval($j) + 1;
        // success
        if ($envoie) {
            // On peut valider le fichier et le stocker définitivement
            $_FILES['photo']['name'] = $i . '.' . $extension_upload;
            $photo = $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], '../../Static/res/livres/' . basename($photo));
        }
        //securité des donners
        $titre = mysqli_real_escape_string($conn, $_POST['titre']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $nbPage = mysqli_real_escape_string($conn, $_POST['nbPage']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        //requete sql
        $sql = "INSERT INTO livre(TITREL, AUTEURL, GENREL, NPAGEL, DESCRIPTION, PHOTO) VALUES('$titre', '$nom', '$genre', '$nbPage', '$description', '$photo')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Livre Ajouter avec Succès')</script>";
            header('refresh: 0.1');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}
