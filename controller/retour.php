<?php
$sql0 = "SELECT * FROM livre WHERE NBEMPRUNTER != 0";
$result = mysqli_query($conn, $sql0);
$resultats = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$retourX = "";

if (isset($_POST['submit01'])) {

    //check livre
    if (empty($_POST['retour'])) {
        $retourX = "Sélectionnez un livre";
    } else {
        $retour = mysqli_real_escape_string($conn, $_POST['retour']);
    }

    //envoie de donner
    if (!empty($retourX)) {
        //rien du tous
    } else {
        $resultat = $connexion->query("SELECT * FROM livre WHERE ID_LIVRE = $retour");
        $nb = $resultat->fetch()['NBEMPRUNTER'];
        $condition = intval($nb);
        if ($condition == 0) {
            echo "<script>alert('Opération non Autoriser')</script>";
            header('refresh: 0.1');
        } else {
            $res = $connexion->query("SELECT * FROM livre WHERE ID_LIVRE = $retour");
            $nbs = $res->fetch()['NBEXEMPLAIRE'];
            $nbe = intval($nbs) + 1;
            //requete sql
            $sqlxx = "UPDATE livre SET NBEXEMPLAIRE = $nbe WHERE ID_LIVRE = $retour";
            // save to db and check
            if (mysqli_query($conn, $sqlxx)) {
                //rien
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
            $nbex = $condition - 1;
            //requete sql 
            $sql = "UPDATE livre SET NBEMPRUNTER = $nbex WHERE ID_LIVRE = $retour";
            // save to db and check
            if (mysqli_query($conn, $sql)) {
                $actif = false;
                $req = $connexion->prepare("UPDATE emprunter SET RETOUNER = :actif WHERE ID_LIVRE = :retour");
                $req->execute(['actif' => $actif, 'retour' => $retour]);
                echo "<script>alert('Retour éffectuer avec Succès')</script>";
                header('refresh: 0.1');
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
        }
    }
}
