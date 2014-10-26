<?php if(!defined("__JGWEDDING__")) die("No Access"); ?>
<div id="footer_names">
	Grace Alyssa Miriam Ehman<br />
	&amp;<br />
	Jesse Nicholas Gadon
</div>
<div id="footer_datetime">
	August 2nd, 2015<br />
	Ceremony: 3:00 PM<br />
	Reception: 5:00 PM
</div>
<div id="footer_location">
	<a href="index.php?page=venu">Hockley Valley Resort<br />793522 Mono 3rd Line<br />Mono, ON<br />L9W 2Y8</a>
</div>
<div id="footer_comment">
	<form id="comment_form" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
		<div><input type="text" placeholder="Your Name:" name="herp" id="herp" value="" /><input type="text" placeholder="Your Email:" name="derp" id="derp" value="" /></div>
		<textarea id="ermahgerd" name="ermahgerd" placeholder="Comment"></textarea>
		<input type="submit" id="submit-myballs" name="submit-myballs" value="Leave a Comment!" />
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#comment_form").submit(function() {
			if($("#ermahgerd").val().trim() === "") {
				alert("Missing comment");
				return false;
			}
			return true;
		});
	});
</script>