<?php
$sql0 = "SELECT * FROM classe";
$result = mysqli_query($conn, $sql0);
$resultats = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$etudiant = array("photo" => '', "nom" => '', "prenom" => '', "matricule" => '', "classe" => '', "adresse" => '');
if (isset($_POST['submit02'])) {

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
            $etudiant['photo'] = 'Erreur de fichier';
        }
    } else {
        $etudiant['photo'] = 'selectionnez une photo';
    }

    //check nom
    if (empty($_POST['nom'])) {
        $etudiant['nom'] = "Entrez un nom";
    } else {
        $nom = htmlspecialchars($_POST['nom']);
        if (!preg_match('/^([a-zA-Zéèàê\s]+)(\s*[a-zA-Zéèàâê\s]*)*$/', $nom)) {
            $etudiant['nom'] = "le nom entré n'est pas valide";
        }
    }

    //check prenom
    if (empty($_POST['prenom'])) {
        $etudiant['prenom'] = "Entrez un prenom";
    } else {
        $prenom = htmlspecialchars($_POST['prenom']);
        if (!preg_match('/^([a-zA-Zéèàê\s]+)(\s*[a-zA-Zéèàâê\s]*)*$/', $prenom)) {
            $etudiant['prenom'] = "le prenom entré n'est pas valide";
        }
    }

    //check adresse
    if (empty($_POST['adresse'])) {
        $etudiant['adresse'] = "Entrée une adresse";
    } else {
        $adresse = htmlspecialchars($_POST['adresse']);
        if (!preg_match('/^([a-zA-Zéèàê\s]+)(,\s*[a-zA-Zéèàâê\s]*)*$/', $adresse)) {
            $etudiant['adresse'] = "l'adresse entré n'est pas valide";
        }
    }

    //check classe
    if (empty($_POST['classe'])) {
        $etudiant['classe'] = "Sélectionnez une classe";
    }

    //check matricule
    if (empty($_POST['matricule'])) {
        $etudiant['matricule'] = "Ecrivez un matricule";
    } else {
        $req = $connexion->prepare('SELECT * FROM etudiant WHERE MATRICULE = ?');
        $req->execute([$_POST['matricule']]);
        $user = $req->fetch();
        if ($user) {
            $etudiant['matricule'] = "Ce matricule existe déjà";
        }
    }

    //envoie de donner
    if (array_filter($etudiant)) {
        //rien du tous
    } else {
        $res = $connexion->query("SELECT * FROM etudiant");
        while ($nbe = $res->fetch()) {
            $j = $nbe['ID_ETUDIANT'];
        }
        $i = intval($j) + 1;
        // success
        if ($envoie) {
            // On peut valider le fichier et le stocker définitivement
            $_FILES['photo']['name'] = $i . '.' . $extension_upload;
            $photo = $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], '../../Static/res/etudiant/' . basename($photo));
        }
        //securité des donners
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $classe = mysqli_real_escape_string($conn, $_POST['classe']);
        $matricule = mysqli_real_escape_string($conn, $_POST['matricule']);
        $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);

        //requete sql
        $sql = "INSERT INTO etudiant(ID_CLASSE, MATRICULE, NOM, PRENOM, ADRESSE, PHOTO) VALUES('$classe', '$matricule', '$nom', '$prenom', '$adresse', '$photo')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            $res = $connexion->query("SELECT * FROM classe");
            while ($nbe = $res->fetch()) {
                $j = $nbe['NBINSCRIT'];
            }
            $i = intval($j) + 1;

            $sqle = "UPDATE classe SET NBINSCRIT = $i WHERE ID_CLASSE = $classe";
            // save to db and check
            if (mysqli_query($conn, $sqle)) {
                //rien
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
            echo "<script>alert('Etudiant Ajouter avec Succès')</script>";
            header('refresh: 0.1');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}
