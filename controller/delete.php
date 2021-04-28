<?php include './connexion.php';
$oeuvre = $_GET['id'];
$livres = $connexion->prepare('DELETE FROM livre WHERE ID_LIVRE = :id');
$livres->execute(['id' => $oeuvre]);
header('Location: ../Views/index.php');