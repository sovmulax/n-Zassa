<?php include './connexion.php';
$oeuvre = $_GET['id'];
$livres = $connexion->prepare('DELETE FROM classe WHERE ID_CLASSE = :id');
$livres->execute(['id' => $oeuvre]);
header('Location: ../Views/classes.php');