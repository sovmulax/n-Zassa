<?php
$sql0 = "SELECT * FROM livre";
$result = mysqli_query($conn, $sql0);
$res = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$exemplaire = array("nbex" => '', "titre" => '');
if (isset($_POST['submit03'])) {

    //check nombre de page
    if ($_POST['nbex'] < 0) {
        $exemplaire['nbex'] = "le nombre d'exemplaires n'est pas valide";
    } else {
        $nbex = htmlspecialchars($_POST['nbex']);
    }

    //check titre
    if (empty($_POST['titre'])) {
        $exemplaire['titre'] = "Sélectionnez un titre";
    } else {
        $titre = $_POST['titre'];
    }

    //envoie de donner
    if (array_filter($exemplaire)) {
        //rien du tous
    } else {
        //requete sql
        $sql = "UPDATE livre SET NBEXEMPLAIRE = $nbex WHERE ID_LIVRE = $titre";
        // save to db and check
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Exemplaire créé avec Succès')</script>";
            header('refresh: 0.1');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}
