<?php

// Remove this to activate the website
exit();

require_once("include.php");
require_once("config.php") or die("Config file does not exist");

if ($Action == "login") {
	$username = $_REQUEST['uname1'];
	$password = $_REQUEST['pwd1'];

	if ($stmt = $mysqli->prepare("SELECT * FROM users WHERE username=? AND password=?")) {
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		$r = $stmt->get_result();

		// Login ok
		if ($data = $r->fetch_assoc()) {
			$_SESSION['Login'] = $data;
			back("/");
		}
		$stmt->close();
	}

	back("/", "Login errato", "danger");
}

if (!$_SESSION['Login']) {
	require_once("tpl/header.htm.php");
	require_once("tpl/login.htm.php");
	require_once("tpl/footer.htm.php");
}
else {
	switch ($Action) {
		case 'logout':
			unset($_SESSION['Login']);
			back("/", "Logout eseguito correttamente");
			break;
		
		case "statistics":
			ob_start();

			$Username = $_SESSION['Login']['username'];
			
			$stmt = $mysqli->prepare(
				"SELECT * FROM clusters c
				LEFT JOIN photos p ON c.photo_id = p.id
				WHERE c.user_id=? AND c.value IS NOT NULL"
			);
			$stmt->bind_param("i", $_SESSION['Login']['id']);
			$stmt->execute();
			$r = $stmt->get_result();
			$PhotosNo = $r->num_rows;

			$stmt = $mysqli->prepare(
				"SELECT * FROM clusters c
				LEFT JOIN photos p ON c.photo_id = p.id
				WHERE c.user_id=? AND c.value IS NULL"
			);
			$stmt->bind_param("i", $_SESSION['Login']['id']);
			$stmt->execute();
			$r = $stmt->get_result();
			$PhotosNot = $r->num_rows;

			require_once("tpl/common.htm.php");

			$Content = ob_get_clean();

			require_once("tpl/header.htm.php");
			require_once("tpl/main.htm.php");
			require_once("tpl/footer.htm.php");
			break;

		case "submit":
			$stmt = $mysqli->prepare(
				"SELECT * FROM clusters c
				LEFT JOIN photos p ON c.photo_id = p.id
				WHERE c.user_id=? AND c.value IS NULL AND c.photo_id=?
				ORDER BY p.id"
			);
			$stmt->bind_param("ii", $_SESSION['Login']['id'], $_REQUEST['id']);
			$stmt->execute();
			$r = $stmt->get_result();
			if ($data = $r->fetch_assoc()) {
				$stmt_up = $mysqli->prepare(
					"UPDATE clusters
					SET value=?, comment=?
					WHERE user_id=? AND photo_id=?"
				);
				$stmt_up->bind_param("isii", $_REQUEST['value'], $_REQUEST['comment'], $_SESSION['Login']['id'], $_REQUEST['id']);
				$stmt_up->execute();
				$stmt_up->close();
				back("/");
			}
			else {
				back("/", "Errore nell'inserimento dei dati", "danger");
			}
			$stmt->close();
			break;

		default:
			// print_r($_SESSION['Login']);

			ob_start();
			$stmt = $mysqli->prepare(
				"SELECT * FROM clusters c
				LEFT JOIN photos p ON c.photo_id = p.id
				WHERE c.user_id=? AND c.value IS NULL
				ORDER BY p.id"
			);
			$stmt->bind_param("i", $_SESSION['Login']['id']);
			$stmt->execute();
			$r = $stmt->get_result();
			if ($data = $r->fetch_assoc()) {
				$Img_URL = $IMG_FOLDER."/".$data['link'];
				$Img_id = $data['photo_id'];
				require_once("tpl/home.htm.php");
			}
			else {
				echo "<p>Non ci sono fotografie da classificare</p>";
			}
			$stmt->close();

			$Content = ob_get_clean();

			require_once("tpl/header.htm.php");
			require_once("tpl/main.htm.php");
			require_once("tpl/footer.htm.php");
			break;
	}
}

$mysqli->close();
unset($_SESSION['message']);
unset($_SESSION['message_kind']);

