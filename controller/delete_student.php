<?php include './connexion.php';
$oeuvre = $_GET['id'];
$livres = $connexion->prepare('DELETE FROM etudiant WHERE ID_ETUDIANT = :id');
$livres->execute(['id' => $oeuvre]);
header('Location: ../Views/etudiants.php');