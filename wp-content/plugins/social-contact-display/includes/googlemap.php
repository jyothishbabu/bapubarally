<?php

if( $addresslineone ) {
$addresslineone = preg_replace('/\s+/', '+', $addresslineone);
}
if( $addresslinetwo ) {
$addresslinetwo = preg_replace('/\s+/', '+', $addresslinetwo);
}
if( $city ) {
$city = preg_replace('/\s+/', '+', $city);
}
if( $county ) {
$county = preg_replace('/\s+/', '+', $county);
}
if( $pcode ) {
$pcode = preg_replace('/\s+/', '+', $pcode);
}

$request = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=" . $addresslineone . "+" . $addresslinetwo . "+" . $city . "+" . $county . "+" . $pcode . "&sensor=false");
$json = json_decode($request, true);

$map_id = uniqid( 'map_' ); // generate a unique ID

<div id="<?php echo esc_attr( $map_id ); ?>" style="height: 300px; width: 300px;"></div>
	    <script type="text/javascript">
			var map_<?php echo $map_id; ?>;
			function run_map_<?php echo $map_id ; ?>(){
				var location = new google.maps.LatLng("<?php echo $json['results'][0]['geometry']['location']['lat']; ?>", "<?php echo $json['results'][0]['geometry']['location']['lng']; ?>");
				var map_options = {
					zoom: 15,
					center: location,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map_<?php echo $map_id ; ?> = new google.maps.Map(document.getElementById("<?php echo $map_id ; ?>"), map_options);
				var marker = new google.maps.Marker({
				position: location,
				map: map_<?php echo $map_id ; ?>
				});
			}
			run_map_<?php echo $map_id ; ?>();
		</script>


?>		