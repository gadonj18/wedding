<?php
	if(!defined("__JGWEDDING__")) die("No access");
	
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "root";
	$db_name = "wedding";
	
	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if($db->connect_errno > 0) die("Error connecting to MySQL database: ".$db->connect_error);