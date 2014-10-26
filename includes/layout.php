<?php if(!defined("__JGWEDDING__")) die("No Access"); ?><!DOCTYPE html>
<html lang="en">
	<head>
		<title>Gadon/Ehman Wedding<?php if(isset($_PAGE["title"]) && strlen(trim($_PAGE["title"])) > 0) echo " - ".$_PAGE["title"]; ?></title>
		<link href="<?php echo CSS_DIR; ?>reset.css" rel="stylesheet" />
		<link href="<?php echo CSS_DIR; ?>style.css" rel="stylesheet" />
		<link href="<?php echo CSS_DIR; ?>responsive.css" rel="stylesheet" />
		<?php foreach($_PAGE["css"] as $css) {
			echo '<link href="'.$css.'" rel="stylesheet" />';
		} ?>
		<script type="text/javascript" src="<?php echo JS_DIR; ?>jquery-1.11.1.min.js"></script>
		<?php foreach($_PAGE["js"] as $js) {
			echo '<script type="text/javascript" src="'.$js.'"></script>';
		} ?>
		<link href='http://fonts.googleapis.com/css?family=Niconne' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="header"><?php include(INC_DIR."header.php"); ?></div>
		<div id="content"><?php echo $_PAGE["content"]; ?><div id="push"></div></div>
		<div id="footer"><?php include(INC_DIR."footer.php"); ?></div>
	</body>
</html>