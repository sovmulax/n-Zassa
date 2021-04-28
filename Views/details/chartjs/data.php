<?php session_start();
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'latash');
define('DB_NAME', 'gl');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$mysqli) {
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$id = intval($_SESSION['id']);
$query = "SELECT ID_ETUDIANT, MONTH(DATESORTIE) FROM emprunter WHERE ID_ETUDIANT = $id";

//execute query
$result = mysqli_query($mysqli, $query);
$resultats = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
//$result = $mysqli->query($query);

//loop through the returned data
$datas = array('0' => 0, '1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0);
foreach ($resultats as $row) {
	for ($i = 0; $i < 11; $i++) {
		if ($i == $row['MONTH(DATESORTIE)'] - 1) {
			$datas[$i] =  $datas[$i] + 1;
		}
	}
}

$data = [['mois' => 'janvier', 'score' => 0], ['mois' => 'fevrier', 'score' => 0], ['mois' => 'mars', 'score' => 0], ['mois' => 'avril', 'score' => 0], ['mois' => 'mai', 'score' => 0], ['mois' => 'juin', 'score' => 0], ['mois' => 'juillet', 'score' => 0], ['mois' => 'aout', 'score' => 0], ['mois' => 'septembre', 'score' => 0], ['mois' => 'octobre', 'score' => 0], ['mois' => 'novembre', 'score' => 0], ['mois' => 'decembre', 'score' => 0]];
for ($i = 0; $i < 11; $i++) {
	$data[$i]['score'] = $datas[$i];
}

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
