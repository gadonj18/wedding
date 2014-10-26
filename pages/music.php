<?php if(!defined("__JGWEDDING__")) die("No Access");

	if(isset($_POST["submit-song"]) && $_POST["submit-song"] === "Request Song") {
		if(!isset($_POST["song-name"]) || strlen(trim($_POST["song-name"])) === 0) {
			$_ERROR = "Song Title Required";
		} else {
			$title = trim($_POST["song-title"]);
			$artist = trim($_POST["song-artist"]);
			
			$sql = "INSERT INTO song_requests (
						song_title, artist
					) VALUES (
						'".esc($db, $title)."', ".($artist === "" ? "NULL" : "'".esc($db, $artist)."'")."
					)";
			if(!$db->query($sql)) {
				emailError("Error inserting song request into database: ".$sql.PHP_EOL.PHP_EOL.$db->error);
				exit(COMMONERROR);
			}
			header("Location: ".$_SERVER["REQUEST_URI"]);
			exit();
		}
	}
	
	if(isset($_POST["song_id"]) && strlen(trim($_POST["song_id"])) > 0 && is_numeric($_POST["song_id"]) && isset($_POST["like"]) && in_array($_POST["like"], array("1", "-1"), true)) {
		$sql = "SELECT 1  
				FROM song_votes 
				WHERE song_id = ".esc($db, $_POST["song_id"])." 
					AND ip_addr = '".esc($db, $_SERVER["REMOTE_ADDR"])."'";
		if(!($result = $db->query($sql))){
			emailError("Error retrieving list of songs from database: ".$sql.PHP_EOL.PHP_EOL.$db->error);
			exit(COMMONERROR);
		}
		$oldVote = null;
		if($result->num_rows > 0) {
			$sql = "UPDATE song_votes 
						SET `like` = ".($_POST["like"] === "1" ? "1" : "0").",
							dislike = ".($_POST["like"] === "1" ? "0" : "1")." 
					WHERE song_id = ".esc($db, $_POST["song_id"])." 
						AND ip_addr = '".esc($db, $_SERVER["REMOTE_ADDR"])."'";
		} else {
			$sql = "INSERT INTO song_votes (
						song_id, ip_addr, `like`, dislike
					) VALUES (
						".esc($db, $_POST["song_id"]).", '".esc($db, $_SERVER["REMOTE_ADDR"])."', ".($_POST["like"] === "1" ? "1, 0" : "0, 1")."
					)";
		}
		if(!$db->query($sql)) {
			emailError("Error inserting song vote into database: ".$sql.PHP_EOL.PHP_EOL.$db->error);
			exit(COMMONERROR);
		}
		header("Location: ".$_SERVER["REQUEST_URI"]);
		exit();
	}

	$sql = "SELECT a.song_id, a.song_title, a.artist, SUM(b.like) AS 'Likes', SUM(b.dislike) AS 'Dislikes' 
			FROM song_requests AS a 
				LEFT JOIN song_votes AS b 
					ON a.song_id = b.song_id 
			GROUP BY a.song_id";
	if(!($result = $db->query($sql))){
		emailError("Error retrieving list of songs from database: ".$sql.PHP_EOL.PHP_EOL.$db->error);
		exit(COMMONERROR);
	}
?>
<h4>Song Requests</h4>
<p>Before requesting a song, please review the existing list to see if it has already been requested. If it has, please "Like" the song rather than re-requesting it.</p>
<br />
<form id="request-form" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
	<label for="song-title">Song Title: </label>
	<input type="text" id="song-title" name="song-title" value="" />
	<label for="song-artist">Artist/Band: </label>
	<input type="text" id="song-artist" name="song-artist" value="" />
	<input type="submit" id="submit-song" name="submit-song" value="Request Song" />
</form>
<p>If you see a requested song that you do NOT like, you can also "Dislike" it!</p>
<table id="request_list">
	<tr>
		<th>Song Title</th>
		<th>Artist/Musician</th>
		<th>Rank</th>
		<th>&nbsp;</th>
	</tr>
	<?php
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<tr>';
				echo '<td>'.$row['song_title'].'</td>';
				echo '<td>'.$row['artist'].'</td>';
				echo '<td>'.($row['Likes'] - $row['Dislikes']).'</td>';
				echo '<td><span class="like" id="like_'.$row["song_id"].'">Like</span> / <span class="dislike" id="dislike_'.$row["song_id"].'">Dislike</span></td>';
				echo '</tr>';
			}
		} else {
			echo '<td colspan="4">No songs requested yet...</td>';
		}
		$result->free();
	?>
</table>
<form id="like_form" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
	<input type="hidden" id="song_id" name="song_id" value="" />
	<input type="hidden" id="like" name="like" value="0" />
</form>
<script type="text/javascript">
	$(document).ready(function() {
		$("#request-form").submit(function() {
			if($("#song-title").val().trim() === "") {
				alert("Missing Song Title!");
				return false;
			}
			return true;
		});
		$("span.like").click(function() {
			var song_id = $(this).attr("id").substr(5);
			$("#song_id").val(song_id);
			$("#like").val("1");
			$("#like_form").submit();
		});
		$("span.dislike").click(function() {
			var song_id = $(this).attr("id").substr(8);
			$("#song_id").val(song_id);
			$("#like").val("-1");
			$("#like_form").submit();
		});
	});
</script>