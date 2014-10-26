<?php if(!defined("__JGWEDDING__")) die("No Access");
	
	$_PAGE["title"] = "Home";
	$_PAGE["js"][] = JS_DIR."jssor.slider.mini.js";
	$_PAGE["js"][] = "https://maps.googleapis.com/maps/api/js";
?>
<script>
    jQuery(document).ready(function ($) {
        var options = { $AutoPlay: true };
        var jssor_slider1 = new $JssorSlider$('hockley_slider', options);
		
		var HockleyValleyLatLang = new google.maps.LatLng(43.977548, -80.046672);
		var mapCanvas = document.getElementById('map_canvas');
		var mapOptions = {
			center: HockleyValleyLatLang,
			zoom: 8,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(mapCanvas, mapOptions);
		
		var directionsService = new google.maps.DirectionsService();
		var directionsDisplay = new google.maps.DirectionsRenderer();
		directionsDisplay.setMap(map);
		
		var marker = new google.maps.Marker({
			position: HockleyValleyLatLang,
			map: map,
			title: 'Hockley Valley Resort'
		});
		
		var lastLoc = "";
		
		$("#map_timmins").click(function() { DirectionsFrom("Timmins, ON"); });
		$("#map_kingston").click(function() { DirectionsFrom("Kingston, ON"); });
		$("#map_ottawa").click(function() { DirectionsFrom("Ottawa, ON"); });
		$("#map_mississauga").click(function() { DirectionsFrom("Mississauga, ON"); });
		$("#map_vaughan").click(function() { DirectionsFrom("Vaughan, ON"); });
		$("#map_toronto").click(function() { DirectionsFrom("Toronto, ON"); });
		$("#map_search").blur(function() { if($(this).val() !== lastLoc) { DirectionsFrom($(this).val()); } });
		$("#map_search").keyup(function(e) { if (e.keyCode == 13 && $(this).val() !== lastLoc) { DirectionsFrom($(this).val()); } });
		
		function DirectionsFrom(loc) {
			$("#map_search").val(loc);
			var request = {
				origin: loc,
				destination: "793522 Mono 3rd Line, Mono ON, L9W 2Y8",
				travelMode: google.maps.TravelMode.DRIVING
			};
			directionsService.route(request, function(result, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(result);
				}
			});
		}
		
    });
</script>
<div style="width:100%; min-height: 490px;">
	<div id="venue_info">
		<h4>Hockley Valley Resort</h4>
		<p>793522 Mono 3rd Line, Mono, ON</p>
		<p>The Hockley Valley Resort is a ski retreat, golf course, conference centre, and hotel in Mono, Ontario, Canada.</p>
		<p>An outdoor saltwater pool is available at the Resort Hockley Valley. An indoor pool, fitness center and 18-hole golf course are also on site.</p>
		<p>This gourmet destination resort features Babbo, a lively lobby bar with an extensive wine list and dining options. Cabin, the resort's signature restaurant, embodies the farm to table philosophy with products from regional farmers. Guests can also enjoy ingredient's from the resort's fruit and vegetable garden.</p>
		<p>Hockley Valley Provincial Nature Reserve is a 15-minute drive from the Hockley Valley Resort. Orangeville is less than a 15-minute drive away, and Luther Marsh Conservation area is a 1-hour drive from the property.</p>
	</div>
	<div id="hockley_slider">
		<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 700px; height: 467px; overflow: hidden;">
			<div><img u="image" src="<?php echo IMG_DIR; ?>hockley_slider/1.png" /></div>
			<div><img u="image" src="<?php echo IMG_DIR; ?>hockley_slider/2.png" /></div>
			<div><img u="image" src="<?php echo IMG_DIR; ?>hockley_slider/3.png" /></div>
			<div><img u="image" src="<?php echo IMG_DIR; ?>hockley_slider/4.png" /></div>
			<div><img u="image" src="<?php echo IMG_DIR; ?>hockley_slider/5.png" /></div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
<div id="venue_map">
	<h4>Directions to Hockley Valley Resort</h4>
	<span>From: </span>
	<ul>
		<li id="map_timmins" class="map_link">Timmins</li>
		<li id="map_kingston" class="map_link">Kingston</li>
		<li id="map_ottawa" class="map_link">Ottawa</li>
		<li id="map_mississauga" class="map_link">Mississauga</li>
		<li id="map_vaughan" class="map_link">Vaughan</li>
		<li id="map_toronto" class="map_link">Toronto (downtown)</li>
		<li>From: <input type="text" id="map_search" name="map_search" value="" placeholder="Enter your location:" /></li>
	</ul>
	<div id="map_canvas"></div>
</div>
<div id="venue_bookings">
	<div id="book_golf">
		<h4>Booking Tee Times</h4>
		<p>To book a tee time, please visit the <a href="http://www.hockley.com/golf/bookings/book-a-tee-time/" target="_blank">Hockley Valley Website</a></p>
	</div>
	<div id="book_spa">
		<h4>Spa Bookings</h4>
		<p>To book a spa service, please visit the <a href="http://www.hockley.com/spa-services/" target="_blank">Hockley Valley Website</a></p>
	</div>
	<div style="clear:both;"></div>
</div>