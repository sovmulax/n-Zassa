<?php
$classe = "";
if (isset($_POST['submit01'])) {
    //check nom
    if (empty($_POST['classe'])) {
        $classe = "Entrée un intitulé";
    } else {
        $nom = htmlspecialchars($_POST['classe']);
        if (!preg_match('/^([a-zA-Zéèàê\s]+)(\s*[0-9\s]+)([a-zA-Zéèàê\s]*)*$/', $nom)) {
            $classe = "l'intitulé entré n'est pas valide";
        }
    }

    //envoie de donner
    if (!empty($classe)) {
        //rien du tous
    } else {
        //securité des donners
        $nom = mysqli_real_escape_string($conn, $_POST['classe']);

        //requete sql
        $sql = "INSERT INTO classe(LIBELLECL) VALUES('$nom')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Classe Ajouter avec Succès')</script>";
            header('refresh: 0.1');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}
