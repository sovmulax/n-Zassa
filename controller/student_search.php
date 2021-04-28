<?php
$sql0 = "SELECT * FROM livre WHERE NBEMPRUNTER != 0";
$result = mysqli_query($conn, $sql0);
$resultatse = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql1 = "SELECT * FROM classe";
$result = mysqli_query($conn, $sql1);
$results = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql2 = "SELECT * FROM etudiant";
$result = mysqli_query($conn, $sql2);
$etu = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

if (isset($_POST['etude'])) {
    if (empty($_POST['nom']) && !empty($_POST['matricule']) and !empty($_POST['livre']) && !empty($_POST['classe'])) {
        $livre = $_POST['livre'];
        $classe = $_POST['classe'];
        $matricule = $_POST['matricule'];
        $sql = "SELECT * FROM etudiant AS e , emprunter AS em WHERE e.ID_ETUDIANT = em.ID_ETUDIANT AND e.MATRICULE LIKE '$matricule' AND em.ID_LIVRE = '$livre' AND e.ID_CLASSE = '$classe'";
    } elseif (empty($_POST['nom']) && empty($_POST['matricule']) && !empty($_POST['livre']) && !empty($_POST['classe'])) {
        $livre = $_POST['livre'];
        $classe = $_POST['classe'];
        $sql = "SELECT * FROM etudiant AS e , emprunter AS em WHERE e.ID_ETUDIANT = em.ID_ETUDIANT AND em.ID_LIVRE = '$livre' AND e.ID_CLASSE = '$classe'";
    } elseif (empty($_POST['nom']) && empty($_POST['matricule']) && empty($_POST['livre']) && !empty($_POST['classe'])) {
        $classe = $_POST['classe'];
        $sql = "SELECT * FROM etudiant  WHERE ID_CLASSE = '$classe'";
    } elseif (empty($_POST['nom']) && !empty($_POST['matricule']) && empty($_POST['livre']) && empty($_POST['classe'])) {
        $matricule = $_POST['matricule'];
        $sql = "SELECT * FROM etudiant WHERE MATRICULE LIKE '$matricule'";
    } elseif (empty($_POST['nom']) && empty($_POST['matricule']) && !empty($_POST['livre']) && empty($_POST['classe'])) {
        $livre = $_POST['livre'];
        $sql = "SELECT * FROM etudiant AS e , emprunter AS em WHERE e.ID_ETUDIANT = em.ID_ETUDIANT AND em.ID_LIVRE = '$livre'";
    } elseif (!empty($_POST['nom']) && !empty($_POST['matricule']) and !empty($_POST['livre']) && !empty($_POST['classe'])) {
        $livre = $_POST['livre'];
        $classe = $_POST['classe'];
        $matricule = $_POST['matricule'];
        $nom = $_POST['nom'];
        $sql = "SELECT * FROM etudiant AS e , emprunter AS em WHERE e.ID_ETUDIANT = em.ID_ETUDIANT AND e.NOM LIKE '$nom' AND e.MATRICULE LIKE '$matricule' AND em.ID_LIVRE = '$livre' AND e.ID_CLASSE = '$classe'";
    } elseif (!empty($_POST['nom']) && empty($_POST['matricule']) and empty($_POST['livre']) && empty($_POST['classe'])) {
        $nom = $_POST['nom'];
        $sql = "SELECT * FROM etudiant WHERE NOM LIKE '$nom'";
    } elseif (!empty($_POST['nom']) && empty($_POST['matricule']) and empty($_POST['livre']) && !empty($_POST['classe'])) {
        $nom = $_POST['nom'];
        $classe = $_POST['classe'];
        $sql = "SELECT * FROM etudiant WHERE NOM LIKE '$nom' AND ID_CLASSE = '$classe'";
    }elseif (!empty($_POST['nom']) && !empty($_POST['matricule']) and empty($_POST['livre']) && empty($_POST['classe'])) {
        $nom = $_POST['nom'];
        $matricule = $_POST['matricule'];
        $sql = "SELECT * FROM etudiant WHERE NOM LIKE '$nom' AND MATRICULE LIKE '$matricule'";
    }elseif (!empty($_POST['nom']) && empty($_POST['matricule']) and !empty($_POST['livre']) && empty($_POST['classe'])) {
        $nom = $_POST['nom'];
        $livre = $_POST['livre'];
        $sql = "SELECT * FROM etudiant AS e , emprunter AS em WHERE e.ID_ETUDIANT = em.ID_ETUDIANT AND e.NOM LIKE '$nom' AND em.ID_LIVRE = '$livre'";
    } else {
        $sql = "SELECT * FROM etudiant";
    }

    $result = mysqli_query($conn, $sql);
    $resultats = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if (empty($resultats)) {
        $vide = "Aucun n'étudiant ne correspond a ces information";
    } else {
        $vide = "";
    }
} else {
    $resultats = [];
    $vide = "";
}
