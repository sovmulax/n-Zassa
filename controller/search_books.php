<?php
if (isset($_POST['livres'])) {
    if (!empty($_POST['titre']) && !empty($_POST['page']) && !empty($_POST['auteur']) && !empty($_POST['dayEmprunt']) && !empty($_POST['dayRetour'])) {
        $titre = $_POST['titre'];
        $page = $_POST['page'];
        $auteur = $_POST['auteur'];
        $dayEmprunt = $_POST['dayEmprunt'];
        $dayRetour = $_POST['dayRetour'];
        $sql = "SELECT * FROM livre AS l, emprunter AS e WHERE l.ID_LIVRE = e.ID_LIVRE AND l.TITREL LIKE '$titre' AND l.NPAGEL = '$page' AND l.AUTEURL LIKE '$auteur' AND e.DATESORTIE = '$dayEmprunt' AND e.DATERETOUR = '$dayRetour'";
    } elseif (empty($_POST['titre']) && !empty($_POST['page']) && !empty($_POST['auteur']) && !empty($_POST['dayEmprunt']) && !empty($_POST['dayRetour'])) {
        $page = $_POST['page'];
        $auteur = $_POST['auteur'];
        $dayEmprunt = $_POST['dayEmprunt'];
        $dayRetour = $_POST['dayRetour'];
        $sql = "SELECT * FROM livre AS l, emprunter AS e WHERE l.ID_LIVRE = e.ID_LIVRE AND l.NPAGEL = '$page' AND l.AUTEURL LIKE '$auteur' AND e.DATESORTIE = '$dayEmprunt' AND e.DATERETOUR = '$dayRetour'";
    } elseif (empty($_POST['titre']) && empty($_POST['page']) && !empty($_POST['auteur']) && !empty($_POST['dayEmprunt']) && !empty($_POST['dayRetour'])) {
        $auteur = $_POST['auteur'];
        $dayEmprunt = $_POST['dayEmprunt'];
        $dayRetour = $_POST['dayRetour'];
        $sql = "SELECT * FROM livre AS l, emprunter AS e WHERE l.ID_LIVRE = e.ID_LIVRE AND l.AUTEURL LIKE '$auteur' AND e.DATESORTIE = '$dayEmprunt' AND e.DATERETOUR = '$dayRetour'";
    } elseif (empty($_POST['titre']) && empty($_POST['page']) && empty($_POST['auteur']) && !empty($_POST['dayEmprunt']) && !empty($_POST['dayRetour'])) {
        $dayEmprunt = $_POST['dayEmprunt'];
        $dayRetour = $_POST['dayRetour'];
        $sql = "SELECT * FROM livre AS l, emprunter AS e WHERE l.ID_LIVRE = e.ID_LIVRE AND e.DATESORTIE = '$dayEmprunt' AND e.DATERETOUR = '$dayRetour'";
    } elseif (empty($_POST['titre']) && empty($_POST['page']) && empty($_POST['auteur']) && !empty($_POST['dayEmprunt']) && empty($_POST['dayRetour'])) {
        $dayEmprunt = $_POST['dayEmprunt'];
        $sql = "SELECT * FROM livre AS l, emprunter AS e WHERE l.ID_LIVRE = e.ID_LIVRE AND e.DATESORTIE = '$dayEmprunt'";
    } elseif (empty($_POST['titre']) && empty($_POST['page']) && empty($_POST['auteur']) && empty($_POST['dayEmprunt']) && !empty($_POST['dayRetour'])) {
        $dayRetour = $_POST['dayRetour'];
        $sql = "SELECT * FROM livre AS l, emprunter AS e WHERE l.ID_LIVRE = e.ID_LIVRE AND e.DATERETOUR = '$dayRetour'";
    } elseif (empty($_POST['titre']) && empty($_POST['page']) && empty($_POST['auteur']) && empty($_POST['dayEmprunt']) && empty($_POST['dayRetour'])) {
        $sql = "SELECT * FROM livre";
    } elseif (empty($_POST['titre']) && !empty($_POST['page']) && empty($_POST['auteur']) && empty($_POST['dayEmprunt']) && empty($_POST['dayRetour'])) {
        $page = $_POST['page'];
        $sql = "SELECT * FROM livre WHERE NPAGEL = '$page'";
    } elseif (empty($_POST['titre']) && empty($_POST['page']) && !empty($_POST['auteur']) && empty($_POST['dayEmprunt']) && empty($_POST['dayRetour'])) {
        $auteur = $_POST['auteur'];
        $sql = "SELECT * FROM livre WHERE AUTEURL = '$auteur'";
    } elseif (!empty($_POST['titre']) && empty($_POST['page']) && empty($_POST['auteur']) && empty($_POST['dayEmprunt']) && empty($_POST['dayRetour'])) {
        $titre = $_POST['titre'];
        $sql = "SELECT * FROM livre WHERE TITREL = '$titre'";
    } elseif (!empty($_POST['titre']) && !empty($_POST['page']) && empty($_POST['auteur']) && empty($_POST['dayEmprunt']) && empty($_POST['dayRetour'])) {
        $titre = $_POST['titre'];
        $page = $_POST['page'];
        $sql = "SELECT * FROM livre WHERE TITREL = '$titre' AND NPAGEL = '$page'";
    } elseif (empty($_POST['titre']) && !empty($_POST['page']) && !empty($_POST['auteur']) && empty($_POST['dayEmprunt']) && empty($_POST['dayRetour'])) {
        $auteur = $_POST['auteur'];
        $page = $_POST['page'];
        $sql = "SELECT * FROM livre WHERE NPAGEL = '$page' AND AUTEURL LIKE '$auteur'";
    } else {
        $sql = "SELECT * FROM livre";
    }

    $result = mysqli_query($conn, $sql);
    $resultats = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if (empty($resultats)) {
        $vide = "Aucun livre ne correspond a ces informations";
    } else {
        $vide = "";
    }
} else {
    $resultats = [];
    $vide = "";
}
