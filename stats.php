<?php

require_once("include.php");
echo "<pre>\n";

$query = "SELECT * FROM clusters_ok WHERE value != 0 AND photo_id = ANY(SELECT photo_id FROM num_annotations WHERE num = 4)";
$result = $mysqli->query($query);
while ($obj = $result->fetch_object()) {
	$comment = $obj->comment;
	$comment = str_replace("\r\n", " ", $comment);
	// $comment = utf8_encode($comment);
	echo "{$obj->user_id}\t{$obj->value}\t{$comment}\n";
} 
