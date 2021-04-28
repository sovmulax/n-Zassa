<?php
$sql0 = "SELECT * FROM livre";
$result = mysqli_query($conn, $sql0);
$resu = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql01 = "SELECT * FROM etudiant";
$result = mysqli_query($conn, $sql01);
$etu = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$emprunt = array("matricule" => '', "titre" => '');
$id = null;
if (isset($_POST['submit00'])) {

    //check titre
    if (empty($_POST['titre'])) {
        $emprunt['titre'] = "Sélectionnez un livre";
    } else {
        $titre = mysqli_real_escape_string($conn, $_POST['titre']);
    }

    //check matricule
    if (empty($_POST['matricule'])) {
        $emprunt['matricule'] = "Ecrivez un Matricule";
    } else {
        $id = null;
        foreach ($etu as $re) {
            $tmp = serialize($_POST['matricule']);
            $res = serialize($re['MATRICULE']);
            if (strcmp($tmp, $res) == 0) {
                $id = $re['ID_ETUDIANT'];
            }
        }
        if (empty($id)) {
            $emprunt['matricule'] = "Matricule Incorrecte ou inexistant";
        }
    }

    //envoie de donner
    if (array_filter($emprunt)) {
        //rien du tous
    } else {
        $resultat = $connexion->query("SELECT * FROM livre WHERE ID_LIVRE = $titre");
        $nb = $resultat->fetch()['NBEXEMPLAIRE'];
        $condition = intval($nb);
        if ($condition == 0) {
            echo "<script>alert('Aucun Exemplaire disponible pour l'emprunt')</script>";
            header('refresh: 0.1');
            exit;
        } else {
            $res = $connexion->query("SELECT * FROM livre WHERE ID_LIVRE = $titre");
            $nbs = $res->fetch()['NBEXEMPLAIRE'];
            $nbe = intval($nbs) - 1;
            //requete sql
            $sqlxx = "UPDATE livre SET NBEXEMPLAIRE = $nbe WHERE ID_LIVRE = $titre";
            // save to db and check
            if (mysqli_query($conn, $sqlxx)) {
                //rien
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
            $resultat = $connexion->query("SELECT * FROM livre WHERE ID_LIVRE = $titre");
            $nb = $resultat->fetch()['NBEMPRUNTER'];
            $nbex = intval($nb) + 1;
            //requete sql
            $sql = "UPDATE livre SET NBEMPRUNTER = $nbex WHERE ID_LIVRE = $titre";

            // save to db and check
            if (mysqli_query($conn, $sql)) {
                //requete sql
                $today = date("Y-m-d");
                $return_day = date('Y-m-d', strtotime('+7 day'));
                $actif = true;
                $sqls = "INSERT INTO emprunter(ID_ETUDIANT, ID_LIVRE, DATESORTIE, DATERETOUR, RETOUNER) VALUES('$id', ' $titre', '$today', '$return_day', '$actif')";

                // save to db and check
                if (mysqli_query($conn, $sqls)) {
                    //insertion fait
                } else {
                    echo 'query error: ' . mysqli_error($conn);
                }
                echo "<script>alert('Emprunt éffectuer avec Succès')</script>";
                header('refresh: 0.1');
                exit;
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
        }
    }
}
