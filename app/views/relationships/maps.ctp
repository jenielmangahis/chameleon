<?php $pagination->setPaging($paging); ?> 
 <!-- Body Panel starts -->
 <script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBZsWgd_AYsjIHhio6SJTb7FY6947sUfPM&sensor=false">
</script>
<?php
$latlongString = "[";
if(count($cmpData))
{
  foreach ($cmpData as $key => $value) {
    if($latlongString =="[")
    {
      $latlongString .= "[".$value[0]. ",".$value[1].",'".$value[2]."']";
    }
    else
    {
      $latlongString .= ",[".$value[0]. ",".$value[1].",'".$value[2]."']";
    }
  }
}
$latlongString .= "]";
$scriptArray = "<script type='text/javascript'> var latlongArray=".$latlongString.";</script>";
echo $scriptArray;
?>

<script>
var myCenter=new google.maps.LatLng(48.508742,-0.120850);

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:5,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

  for(var i=0;i<latlongArray.length;i++)
  { 
    var latlong=new google.maps.LatLng(latlongArray[i][0],latlongArray[i][1]);
    var marker=new google.maps.Marker({
      position:latlong,
    });

    marker.setMap(map);

    var infowindow = new google.maps.InfoWindow({
    content:latlongArray[i][2]
    });

    infowindow.open(map,marker);
  }
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<!--container starts here-->
<div class="container clearfix">
	<div class="titlCont">
    	<div class="slider-centerpage clearfix">
			<div class="center-Page col-sm-6">
            	<h2>Map Relationship</h2>
            </div>
            <div class="slider-dashboard col-sm-6">
            	<div class="icon-container">
                	<?php echo $form->create("Relationships", array("action" => "activelinklist",'name' => 'activelinklist', 'id' => "activelinklist")) ?>
					<script type='text/javascript'>
                            function setprojectid(projectid){
                                            document.getElementById('projectid').value= projectid;
                                            document.adminhome.submit();
                                    }
                    </script>    
                    <?php echo $this->renderElement('new_slider');?>               			
                </div>
                 
            </div>
            <!--<span style="padding-top:17px !important" class="titlTxt1">&nbsp;</span>
            <span class="titlTxt"> Map Relationship </span>-->
			<div class="topTabs" style="height:25px;">
<!--<ul class="dropdown">
<li>
<?php
	//e($html->link(
//		$html->tag('span', 'New'),
//		array('controller'=>'relationships','action'=>'addlink'),
//		array('escape' => false)
//		)
//	);
?>

</li>
<li><a href="javascript:void(0)" class="tab2"><span>Actions</span></a>
<ul class="sub_menu">
                                 <!--li><a href="javascript:void(0)" onclick="return activatecontents('active','change');">Publish</a></li>
                                 <li><a href="javascript:void(0)" onclick="return activatecontents('deactive','change');">Unpublish</a></li-->
                                 <!--li><a href="javascript:void(0)">Copy</a></li-->
                               <!--  <li><a href="javascript:void(0)" onclick="return activatecontents('asd','del');">Trash</a></li>
                     <li class="botCurv"></li>
                        </ul>
</li>
<li><a href="javascript:void(0)" onclick="editcontent();" id="linkedit"><span>Edit</span></a></li>
</ul>-->
</div>
			<!--<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">				
			</div>-->
        </div>
</div>

<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		<?php    $this->loginarea="relationships";    $this->subtabsel="maps";
             echo $this->renderElement('relationships_submenus');  ?>   
    </div>
</div>


<div class="midCont" id="newcmmtasktab">


<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;  position: absolute;   z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div>
                                            <?php } ?>

                            <!-- top curv image starts -->
                         

  <div>
          <table class="table">
          <tr>
            <td valign="top" align="left">
              <h2><label class="boldlabel">Relationship Type</label></h2>
            </td>
            <td>
          <?php
              $groupdata = array(
                                      '1' => 'Company',
                                      '2' => 'Contact',
                                      '3' => 'Customer',
                                      '4' => 'Branches',
                                      '5' => 'Los',
									  '6' => 'Employees',
									  '7' => 'Correspondents',
									  '8' => 'Brokers',
									  '9' => 'Others'
                                );
          ?>
          <!--<span class="txtArea_top"> <span class="txtArea_bot"> -->
          <?php
            echo $form->input("Relationship.group",array('type' => 'select','options' => $groupdata,
    'multiple' => 'checkbox','class'=>'multilist','label' => false,'selected' => $chkSelected)); 
          ?>
          </span>
          </span>
              </td>
            </tr>
          </table>
  </div>                          
  <div>

        
        <div id="googleMap" style="width:auto;height:500px;"></div>  

  </div>



<div class="clear"></div>
    </div>
    
         <div class="clear"></div>
</div>      
<script type="text/javascript">
$(document).ready(function() {
    //set initial state.
    $("input[type='checkbox']").change(function() {
        if($(this).is(":checked")) 
        {
            var groupType = $(this).val();
            var cSelected = "<?php  echo $chkSelected;?>";
            if(groupType!="0"&&groupType!=cSelected)
              { 
                  window.location = baseUrl+'relationships/maps/'+groupType;
              }
        }
    });
});
</script>    
