<?php

$key = "ABQIAAAAhOrd2PymbcCg8qzesMCFZxTDhNZg3e_FdtXZy07jh8RG8uoSbhRuN6nPEiwQpz6F_hugSzNzN-AZzg";	
				
$address = urlencode('rajajipuram,lucknow,uttar pradesh,226020,india');
 
//If you want an extended data set, change the output to "xml" instead of csv
$url = "http://maps.google.com/maps/geo?q=".$address."&output=csv&key=".$key;
//Set up a CURL request, telling it not to spit back headers, and to throw out a user agent.
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER,0); //Change this to a 1 to return headers
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
$data = curl_exec($ch);
curl_close($ch);
 
if (substr($data,0,3) == "200")
{
$data = explode(",",$data);
 
echo $precision = $data[1];
echo $lat = $data[2];
echo $lng = $data[3];
 
}

?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $key; ?>"  type="text/javascript"></script>
<link href="css/styles.css" rel="stylesheet" type="text/css"></link>


<div id="map" style="float:left width: 600px; height: 400px;" ></div>		
	
<div id="streetview" style="width: 500px; height: 400px;"></div>
	    		
					
    
    <!-- end street view -->
   		 
   		 
   		 



<!-- key=ABQIAAAAds5wc0K7YpIeJDXi_zYkTxRjBl3riBkNP7yhp-h4fLSwWnSdMxRr4pPGPF5U9dEQPf-7ezjx2gaqlA //local -->

<!-- key=ABQIAAAAds5wc0K7YpIeJDXi_zYkTxRcAamyOrCtuFY1gTEuQ52OGNXRlxQjd2FWTDLHR8Alf_svxH5uHBAYUg" //live -->



   <script type="text/javascript">
    //<![CDATA[
load();
    function load() {
      if (GBrowserIsCompatible()) {
		//var lat = -33.867141;
		//var lng = 151.207114;
		var lat = <?php echo $lat?$lat:"-33.867141"; ?>;
		var lng = <?php echo $lng?$lng:"151.207114"; ?>;
        var map = new GMap2(document.getElementById("map"));
		map.addControl(new GSmallMapControl());
		map.addControl(new GMapTypeControl());
		map.setCenter(new GLatLng(lat,lng), 15);

		var infoTabs = [
  		new GInfoWindowTab("Address", "<?php echo $fulladdress; ?>"),
		];

		// Place a marker in the center of the map and open the info window
		var marker = new GMarker(map.getCenter());
		GEvent.addListener(marker, "click", function() {
  		marker.openInfoWindowTabsHtml(infoTabs);
		});
		map.addOverlay(marker);
		marker.openInfoWindowTabsHtml(infoTabs);

		var point = new GLatLng(lat,lng);
		panoramaOptions = { latlng:point };
		pano = new GStreetviewPanorama(document.getElementById("map"), panoramaOptions);
		GEvent.addListener(pano);

	}
    }

    //]]>
</script>
