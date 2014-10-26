<?php
	define("__JGWEDDING__", 1);
	define("DEBUG", 1);

	define("BASE_DIR", "/wedding/");
	define("INC_DIR", "/includes/");
	define("PAGE_DIR", "/pages/");
	define("CSS_DIR", BASE_DIR."css/");
	define("JS_DIR", BASE_DIR."scripts/");
	define("IMG_DIR", BASE_DIR."images/");
	
	if(DEBUG) {
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	}
	
	include(INC_DIR."db.php");
	include(INC_DIR."common.php");
	include(INC_DIR."auth.php");
	
	$_PAGE = array(
		"name" => "home.php",
		"title" => "",
		"content" => "",
		"css" => array(),
		"js" => array()
	);
	
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