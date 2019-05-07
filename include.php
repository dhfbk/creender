<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", "On");

session_start();

$Action = $_REQUEST['action'];

// print_r($Config);

$mysqli = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD);
if( !$mysqli ){
	die("Error: a related error message");
}
$mysqli->select_db($DB_NAME);

// Functions

function back($url, $message = "", $kind = "success") {
	header("Location: " . $url);
	if ($message) {
		$_SESSION['message'] = $message;
		$_SESSION['message_kind'] = $kind;
	}
	exit();
}
