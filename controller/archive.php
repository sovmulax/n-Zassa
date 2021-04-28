<?php
$search = array("matricule" => '', "livre" => '', "classe"=>'', "nom"=>'');

$sql0 = "SELECT * FROM livre WHERE NBEMPRUNTER != 0";
$result = mysqli_query($conn, $sql0);
$resultats = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql1 = "SELECT * FROM classe";
$result = mysqli_query($conn, $sql1);
$results = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql2 = "SELECT * FROM etudiant";
$result = mysqli_query($conn, $sql2);
$etu = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$ids = array();
$etudiant = null;
$id_etu = null;
if (isset($_POST['etude'])) {
    if (empty($_POST['nom'] && !empty($_POST['matricule']) and !empty($_POST['livre']) && !empty($_POST['classe']))) {
        $id_livre = $_POST['livre'];
        foreach ($etu as $re) {
            $tmp = strtolower(serialize($_POST['matricule']));
            $res = strtolower(serialize($re['MATRICULE']));
            if (strcmp($tmp, $res) == 0) {
                $id_etu = $re['ID_ETUDIANT'];
            }
        }
        if (empty($id_etu)) {
            $search['matricule'] = "Matricule Incorrecte ou inexistant";
        }
        
        $livre = $connexion->query("SELECT * FROM emprunter WHERE ID_LIVRE = $id_etu AND ID_ETUDIANT = $id_livre");
        if($livre->fetch()){
            $etudiant = $livre->fetch()['ID_ETUDIANT'];
        }
        
    } elseif (empty($_POST['nom']) && empty($_POST['matricule']) && !empty($_POST['livre']) && !empty($_POST['classe'])) {
    } elseif (empty($_POST['nom']) && empty($_POST['matricule']) && empty($_POST['livre']) && !empty($_POST['classe'])) {
    } elseif (empty($_POST['nom']) && empty($_POST['matricule']) && empty($_POST['livre']) && empty($_POST['classe'])) {
    } else {
    }
}
