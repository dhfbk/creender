<?php

$UsersPerPhoto = 4;
$Users = 1;
$ResetUsers = true;
$DebugUser = 2;
$PhotosToDebugUsers = 100;
$DefaultLang = "it";

// Just to be sure
if (!isset($argv[1]) || $argv[1] != "pippo") {
	exit();
}

$BaseForId = pow(10, strlen($Users));

require_once("config.php");
require_once("include.php");

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
	if (file_exists("random_words.txt")) {
		$fn = fopen("random_words.txt", "r");
		$parole = array();

		while(!feof($fn))  {
			$result = fgets($fn);
			$result = trim($result);
			if (strlen($result) > 0) {
				$parole[] = $result;
			}
		}

		fclose($fn);
	}
	$n = $parole[rand(0, count($parole) - 1)];
	$n .= str_pad(rand(1, 999), 3, "0", STR_PAD_LEFT);
	$n .= randomPassword();
	return $n;
}

function randomPassword($len = 1) {
	$alphabet = '!@#?%$';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < $len; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}

function generateUserId($institution, $idui) {
	global $BaseForId;
	if ($idui > $BaseForId) {
		die("User id is not valid");
	}
	return $institution * $BaseForId + $idui;
}

$scanned_directory = array_diff(scandir($directory), array('..', '.'));

if ($ResetUsers) {
	$mysqli->query("DELETE FROM users WHERE id != 2");
	for ($i = 0; $i < $Users; $i++) { 
		for ($j = 0; $j < $UsersPerPhoto; $j++) { 
			$institution = $j + 1;
			$idui = $i + 1;
			$user_id = generateUserId($institution, $idui);
			$user = "c{$institution}u{$idui}";
			$password = generaPassword();
			print("Creating user {$user}\n");
			$query = "INSERT INTO users VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("isssis", $user_id, $user, $user, $password, $institution, $DefaultLang);
			$stmt->execute();
		}
	}
}

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

	if ($i % 25 == 0) {
		echo "$i photo inserted\n";
	}

	$pPhotos->execute();
	
	if ($i <= $PhotosToDebugUsers) {
		$user_id = $DebugUser;
		$pClusters->execute();
		continue;
	}

	$idui = ($i - $PhotosToDebugUsers) % $Users;
	if ($idui == 0) {
		$idui = $Users;
	}

	for ($j = 1; $j <= $UsersPerPhoto; $j++) {
		$user_id = generateUserId($j, $idui);
		$pClusters->execute();
	}
}

$pPhotos->close();
$pClusters->close();
