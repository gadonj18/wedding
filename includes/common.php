<?php if(!defined("__JGWEDDING__")) die("No Access");
	
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