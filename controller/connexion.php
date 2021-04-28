<?php
#section 1
$connexion = new PDO("mysql:host=localhost;dbname=gl", "root", "latash");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<?php
#section 2
$conn = mysqli_connect('localhost', 'root', 'latash', 'gl');
// check connection
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}