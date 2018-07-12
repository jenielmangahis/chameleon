<div class="leftPanel">
<?php echo  $form->create('Companies',array('action'=>'gmap','id'=>'gmap','name'=>'gmap'));?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=<?php echo MAP_API_KEY; ?>" type="text/javascript"></script>
<?php
$showcomments="no";
 if($project['ProjectType']['iscommentpublic']=="0"){
if(!empty($_SESSION['User']['User']['id'])) $showcomments="yes";
 } 
else  $showcomments="yes";

$zoomview="09";

if(sizeof($holderdetails)==0){
?>
<p align="center"><b>No data available. </b></p>
<?php }else { 

$newaddress='';
$firstname="";
$i=0;
foreach($holderdetails as $convalue1){
	if($i==0) $firstcountryid=$convalue1['Holder']['country'];
	if($firstcountryid != $convalue1['Holder']['country']) 
	{	$zoomview="01";
		break;
	}
	$i++;
}
foreach($holderdetails as $convalue){
			$firstname = $convalue['Holder']['firstname'];
			if($showcomments=="yes"){
			$newaddress = $convalue['Holder']['address1'].', '.$convalue['Holder']['city'].', '.AppController::getstatename($convalue['Holder']['state']).' '.AppController::getstatename($convalue['Holder']['zipcode']).', '.AppController::getcountryname($convalue['Holder']['country']).'@ <strong>Coin #: </strong>'.$convalue['CoinsHolder']['serialnum'].'<br><strong>Holder: </strong>'.$firstname.' <br> <strong>Comment:</strong> '.$convalue['Comment']['comment'].'|'.$newaddress;
			}
			else{
			$newaddress = $convalue['Holder']['address1'].', '.$convalue['Holder']['city'].', '.AppController::getstatename($convalue['Holder']['state']).' '.AppController::getstatename($convalue['Holder']['zipcode']).', '.AppController::getcountryname($convalue['Holder']['country']).'@ <strong>Coin #: </strong>'.$convalue['CoinsHolder']['serialnum'].'<br><strong>Holder: </strong>'.$firstname.'|'.$newaddress;
			}
}
 $newaddress=substr($newaddress, 0, -1);	

?>
<input type='hidden' id='addressID' name='addressID' value ='<?php echo $newaddress; ?>'>
<div id="map_canvas" style="width: 700px; height: 500px"></div>

<script type = "text/javascript">


function showlocations(address,ind,comment) {
	
	  if (geocoder) {
		geocoder.getLatLng(
		  address,
		  function(point) {
			if (!point) {
			  //alert(address + " not found");
			} else {
			  map.setCenter(point, <?php echo $zoomview ?>);
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
//var addressstring ='chicago, California , United States@<strong>Coin #: </strong>ABC0000001<br><strong>Holder: </strong>amol<br> <strong>Comment:</strong> this itest comment fgfdgfdgfdgdfg dfg dfg ggfhgfh|2731 W Schubert Ave, Chicago, Illinois , United States@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Prashant <br> <strong>Comment:</strong> This test hjhjhgghjghghjghjhcomments..|Michael A, Kearny, NJ, United States@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Michael <br> <strong>Comment:</strong> This test comments..|918 S.W. Mudd Hall, Mailcode: 4711, 500 W.120th Street New York, NY, United States@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Ah-Hyung <br> <strong>Comment:</strong> This test comments..|Columbia University,420 Riverside Drive #11E New York, NY, United States@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Xinxin Li<br> <strong>Comment:</strong> This test comments..|Lamont-Doherty Earth Observatory of Columbia University,61 Route 9W, Palisades NY,United States@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Juerg Matter<br> <strong>Comment:</strong> This test comments..|Arizona State University,Department of Chemistry, Main Campus,Tempe Arizona,85287-1604,United States@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Andrew<br> <strong>Comment:</strong> This test comments..|Wyoming State Geological Survey, P.O. Box 1347, Laramie Wyoming,USA,82073@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Joan Binder<br><strong>Comment:</strong> This test comments..|Wyoming State Geological Survey, P.O. Box 1347,  307-766-2286 Laramie Wyoming, Ext. 223 USA,82073@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Ronald  <br> <strong>Comment:</strong> This test comments..|Wyoming State Geological Survey, P.O. Box 1347,Laramie Wyoming,USA,82073@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Zunsheng <br> <strong>Comment:</strong> This test comments..|Monmouth Junction, NJ,USA,08852@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Zunsheng <br> <strong>Comment:</strong> This test comments..|Argonne National Argonne National Laboratory,9700 S. Cass  Ave., Argonne, Illinois USA, 60439@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>Richard D.<br> <strong>Comment:</strong> This test comments..|9190 PKWY,BIRMINGHAM, AL,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>PARKWAY E<br> <strong>Comment:</strong> This test comments..|801 20TH ST S,BIRMINGHAM, AL,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>UNIVERSITY & 20TH<br> <strong>Comment:</strong> This test comments..|3800 GULF SHORE PKWY,GULF SHORES, AL,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>HWY 59 & CR 4<br> <strong>Comment:</strong> This test comments..|1830 29TH AVE S,HOMEWOOD, AL,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>29TH & FIREFIGHTER<br> <strong>Comment:</strong> This test comments..|5901 UNIVERSITY DR,HUNTSVILLE, AL,USA@ <strong>Coin #:</strong>ABC0000008<br><strong>Holder: </strong>MADISON<br> <strong>Comment:</strong> This test comments..|3451 SPRING HILL AVE,MOBILE, AL,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>I-65 & SPRING HILL<br> <strong>Comment:</strong> This test comments..|4725 MAIN STx,ORANGE BEACH, AL,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>FOLEY BEACH & CANAL<br> <strong>Comment:</strong> This test comments..|2531 ROCKY RIDGE RD,VESTAVIA HILLS, AL,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>ROCKY RIDGE & MORGAN<br> <strong>Comment:</strong> This test comments..|3351 PINNACLE HILLS PKWY,ROGERS, AR,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>PINNACLE HILLS & NORTHGATE<br> <strong>Comment:</strong> This test comments..|2008 FAYETTEVILLE RD,VAN BUREN, AR,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>HWY 59 & RENA<br> <strong>Comment:</strong> This test comments..|4985 N SUNLAND GIN RD, AL,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>ELOY<br> <strong>Comment:</strong> This test comments..|1 E VALLEY BLVD,ALHAMBRA, CA,USA@<strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>GARFIELD & VALLEY<br> <strong>Comment:</strong> This test comments..|2420 E KATELLA AVE,ANAHEIM, CA,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>KATELLA & 57 FWY<br> <strong>Comment:</strong> This test comments..|1861 BELLEVUE RD,ATWATER, CA,USA@ <strong>Coin #: </strong>ABC0000008<br><strong>Holder: </strong>BELLEVUE & WINTON<br><strong>Comment:</strong> This test comments..';
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
<?php }?>
<?php echo $form->end();?>
</div>