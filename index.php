<?php
	define("__JGWEDDING__", 1);
	define("DEBUG", 1);

	define("BASE_DIR", "/wedding/");
	define("INC_DIR", "/includes/");
	define("PAGE_DIR", "/pages/");
	define("CSS_DIR", BASE_DIR."css/");
	define("JS_DIR", BASE_DIR."scripts/");
	define("IMG_DIR", BASE_DIR."images/");
	define("COMMONERROR", "Whoops! There appears to be an unexpected error!<br /><br />If the problem persists, email me at <a href='mailto:gadonj18@live.com'>gadonj18@live.com</a>");
	
	if(DEBUG) {
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	}
	
	include(INC_DIR."db.php");
	include(INC_DIR."common.php");
	include(INC_DIR."auth.php");
	
	$_PAGE = array(
		"name" => "home.php",
		"flash" => "",
		"title" => "",
		"content" => "",
		"css" => array(),
		"js" => array()
	);
	
	if(isset($_POST["submit-myballs"]) && $_POST["submit-myballs"] === "Leave a Comment!") {
		if(isset($_POST["ermahgerd"]) && strlen(trim($_POST["ermahgerd"])) > 0) {
			$name = (isset($_POST["herp"]) && strlen(trim($_POST["herp"])) > 0 ? "'".esc($db, trim($_POST["herp"]))."'" : "NULL");
			$email = (isset($_POST["derp"]) && strlen(trim($_POST["derp"])) > 0 ? "'".esc($db, trim($_POST["derp"]))."'" : "NULL");
			$comment = "'".esc($db, $_POST["ermahgerd"])."'";
			
			$sql = "INSERT INTO comments (
						ip_addr, name, email, comment
					) VALUES (
						'".esc($db, $_SERVER["REMOTE_ADDR"])."', ".$name.", ".$email.", ".$comment."
					)";
			if(!$db->query($sql)) {
				emailError("Error inserting comment into database: ".$sql.PHP_EOL.PHP_EOL.$db->error);
			}
			emailComment($name, $email, $comment);
			header("Location: ".$_SERVER["REQUEST_URI"]);
			exit();
		} else {
			$_PAGE["flash"] = "Missing comment!";
		}
	}
	
	if(isset($_GET["page"])) {
		switch($_GET["page"]) {
			case "venue":
				$_PAGE["name"] = "venue.php";
				break;
			case "accommodations":
				$_PAGE["name"] = "accommodations.php";
				break;
			case "music":
				$_PAGE["name"] = "music.php";
				break;
			case "officiant":
				$_PAGE["name"] = "officiant.php";
				break;
			case "registry":
				$_PAGE["name"] = "registry.php";
				break;
			case "home":
			default:
				$_PAGE["name"] = "home.php";
				break;
		}
	}
	
	ob_start();
	include(PAGE_DIR.$_PAGE["name"]);
	$_PAGE["content"] = ob_get_contents();
	ob_clean();
	include(INC_DIR."layout.php");