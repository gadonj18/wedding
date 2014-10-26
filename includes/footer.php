<?php if(!defined("__JGWEDDING__")) die("No Access"); ?>
<div id="footer_names">
	Grace Alyssa Ehman<br />
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
	<form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
		<div><input type="text" placeholder="Your Name:" name="name" id="name" value="" /><input type="text" placeholder="Your Email:" name="email" id="email" value="" /></div>
		<textarea id="comment" name="comment" placeholder="Comment"></textarea>
		<input type="submit" id="submit-comment" name="submit-comment" value="Leave a Comment!" />
	</form>
</div>