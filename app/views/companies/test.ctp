<div class="leftPanel">
<?php echo  $form->create('Companies',array('action'=>'gmap','id'=>'gmap','name'=>'gmap'));?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAlk2ZeEtNAqoFFIJ2zopCVRTDhNZg3e_FdtXZy07jh8RG8uoSbhSTD11JWwoJTjjqHDal3wW90vJ5eg" type="text/javascript"></script>
<?php

if(sizeof($holderdetails)==0){
}else { 

$newaddress='';
$firstname="";

foreach($holderdetails as $convalue){
			$firstname = $convalue['Holder']['firstname'];
			$newaddress = $convalue['Holder']['address1'].', '.AppController::getcountryname($convalue['Holder']['country']).', '.AppController::getstatename($convalue['Holder']['state']).', '.$convalue['Holder']['city'].'@ <strong>Coin #: </strong>'.$coinserial.'<br><strong>Holer: </strong>'.$firstname.' <br> <strong>Comment:</strong> '.$convalue['Comment']['comment'].'|'.$newaddress;
		
 }
 $newaddress=substr($newaddress, 0, -1);	
}

?>
<input type='hidden' id='addressID' name='addressID' value ='<?php echo $newaddress; ?>'>

<div id="map_canvas" style="width: 600px; height: 500px"></div>
<script type = "text/javascript">


function showlocations(address,ind,comment) {
	//alert(address);
	  if (geocoder) {
		geocoder.getLatLng(
		  address,
		  function(point) {
			if (!point) {
			  alert(address + " not found");
			} else {
			  map.setCenter(point, 10);
			  //marker = new GMarker(point);
			  var xMarker;
			  xMarker=drawmarker(point,ind,address,comment);
			  map.addOverlay(xMarker);
			 //xMarker.openInfoWindowHtml(address);
			 
			}
		  }
		);
	  }
}
if (GBrowserIsCompatible()) {
var map = new GMap2(document.getElementById("map_canvas"));

map.addControl(new GLargeMapControl());

//map.setCenter(new GLatLng(37.97918, 23.716647),16);
geocoder = new GClientGeocoder();



// Add 10 markers to the map at random locations
var bounds = map.getBounds();
var addressstring = document.gmap.addressID.value;
var listArray = addressstring.split("|");
for (var i = 0; i < listArray.length; ++i) {
			newarrylist = listArray[i].split("@");
			showlocations(newarrylist[0],i,newarrylist[1]);
			}

}


function drawmarker(point, index,address,comment) {
// Create a lettered icon for this point using our icon class
var letter = String.fromCharCode("A".charCodeAt(0) + index);
var letteredIcon = new GIcon(G_DEFAULT_ICON);
letteredIcon.image = "http://www.google.com/mapfiles/marker" + letter + ".png";

// Set up our GMarkerOptions object
markerOptions = { icon:letteredIcon };
var marker = new GMarker(point, markerOptions);

GEvent.addListener(marker, "click", function() {
marker.openInfoWindowHtml(comment);
});
return marker;
}
    </script>						

<?php echo $form->end();?>
</div>
