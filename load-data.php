<?php

// Remove this to activate the tool
exit();

if (!isset($argv[1]) || $argv[1] != "pippo") {
	exit();
}

require_once("include.php");
require_once("config.php") or die("Config file does not exist");

function generaPassword() {
	$parole = array(
		"topolino",
		"pippo",
		"paperino",
		"gambadilegno",
		"macchianera",
		"bandabassotti",
		"nonnapapera",
		"paperina",
		"minnie",
		"pluto",
		"archimede",
		"clarabella",
		"orazio",
		"ziopaperone",
		"gastone",
		"paperoga",
		"paperina",
		"battista"
		);
	$n = $parole[rand(0, count($parole) - 1)];
	$n .= str_pad(rand(1, 999), 3, "0", STR_PAD_LEFT);
	return $n;
}

function randomPassword() {
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}


$scanned_directory = array_diff(scandir($directory), array('..', '.'));

// $mysqli->query("DELETE FROM users WHERE id != 2");
// for ($i=0; $i < 15; $i++) { 
// 	for ($j=0; $j < 2; $j++) { 
// 		$institution = $j + 1;
// 		$idui = $i + 1;
// 		$user_id = $institution * 100 + $idui;
// 		$user = "c{$institution}u{$idui}";
// 		$password = generaPassword();
// 		$query = "INSERT INTO users VALUES (?, ?, ?, ?, ?)";
// 		$stmt = $mysqli->prepare($query);
// 		$stmt->bind_param("isssi", $user_id, $user, $user, $password, $institution);
// 		$stmt->execute();
// 	}
// }
// exit();

$mysqli->query("DELETE FROM clusters");
$mysqli->query("DELETE FROM photos");

$qPhotos = "INSERT INTO photos (id, link) VALUES (?, ?)";
$pPhotos = $mysqli->prepare($qPhotos);

$qClusters = "INSERT INTO clusters (user_id, photo_id) VALUES (?, ?)";
$pClusters = $mysqli->prepare($qClusters);

$i = 0;
$file = "";
$user_id = 0;

$pPhotos->bind_param("is", $i, $file);
$pClusters->bind_param("ii", $user_id, $i);

foreach ($scanned_directory as $file) {
	$i++;
	// if ($i % 1000 > 10 || $i % 1000 == 0) {
	// 	continue;
	// }

	if ($i % 25 == 0) {
		echo "$i\n";
	}

	$pPhotos->execute();

	// echo $mysqli->error."\n";

	$u = intdiv($i - 1, 1000) + 1;
	for ($j=1; $j <= 2; $j++) { 
		$user_id = (100 * $j) + $u;

		if ($u == 16) {
			$user_id = 2;
		}

		$pClusters->execute();
		if ($user_id == 2) {
			break;
		}

		// echo $mysqli->error."\n";
	}
	// echo "$file\n";
}

$pPhotos->close();
$pClusters->close();
