<?php if(!defined("__JGWEDDING__")) die("No Access"); ?>
<div id="title"><a href="index.php"><img src="<?php echo IMG_DIR; ?>title.png" /></a></div>
<div id="menu">
	<ul>
		<li class="<?php if($_PAGE["name"] == "home.php") echo "active" ?>"><a href="index.php">Home</a></li>
		<li class="<?php if($_PAGE["name"] == "venue.php") echo "active" ?>"><a href="index.php?page=venue">Venue</a></li>
		<li class="<?php if($_PAGE["name"] == "accommodations.php") echo "active" ?>"><a href="index.php?page=accommodations">Accommodations</a></li>
		<li class="<?php if($_PAGE["name"] == "music.php") echo "active" ?>"><a href="index.php?page=music">Music</a></li>
		<li class="<?php if($_PAGE["name"] == "officiant.php") echo "active" ?>"><a href="index.php?page=officiant">Officiant</a></li>
		<li class="last <?php if($_PAGE["name"] == "registry.php") echo " active" ?>"><a href="index.php?page=registry">Registry</a></li>
		<!--<li class="last<?php if($_PAGE["name"] == "blog.php") echo " active" ?>"><a href="index.php?page=blog">Blog</a></li>-->
	</ul>
</div>