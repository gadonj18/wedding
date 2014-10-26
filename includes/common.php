<?php if(!defined("__JGWEDDING__")) die("No Access");
	
	function emailComment($name, $email, $comment) {
		require_once(INC_DIR."class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->AddAddress("gadonj18@live.com", "Jesse Gadon");
		$mail->Subject = "Wedding Website - New Comment";
		$mail->MsgHtml("New comment from ".$name." (".$email.") at ".date("Y-m-d H:i:s").PHP_EOL.PHP_EOL.$comment);
		if(!$mail->Send()) {
			emailError("Error sending comment email: ".$mail->ErrorInfo);
		}
	}
	
	function emailError($msg) {
		require_once(INC_DIR."class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->AddAddress("gadonj18@live.com", "Jesse Gadon");
		$mail->Subject = "Wedding Website - ERROR";
		$mail->MsgHtml("Error discovered at ".date("Y-m-d H:i:s")." by ".$_SERVER["REMOTE_ADDR"].PHP_EOL.PHP_EOL.$msg);
		if(!$mail->Send()) {
			die(COMMONERROR);
		}
	}
	
	function esc($db, $string) {
		return $db->escape_string($string);
	}
	
	function debug($var) {
		return "<pre style='text-align:left;'>".print_r($var, true)."</pre>";
	}
	
	function query($sql, $assoc = false) {
		$data = array();
		$result = mysql_query($sql);
		if($result) {
			if(strtoupper(substr($sql, 0, 6)) === "SELECT") {
				if(mysql_num_rows($result) > 0) {
					if($assoc == true) {
						while($row = mysql_fetch_assoc($result)) {
							$data[] = $row;
						}
					} else {
						while($row = mysql_fetch_row($result)) {
							$data[] = $row;
						}
					}
				}
				mysql_free_result($result);
			} else $data = $result;
		} else $data = null;
		return $data;
	}