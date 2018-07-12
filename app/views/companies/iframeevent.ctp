<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
    newwindow=window.open(url,'name','height=600,width=650');
    if (window.focus) {newwindow.focus()}
    return false;
}
// -->
</script>

<style type="text/css">
	.contentlist li{
		margin: 5px;
	}
</style>

<div class="boxBg1">

  <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>
  <div class="boxBor1">
  <div class="boxPad">
    <!--&nbsp;&nbsp;&nbsp;<font size="+2" color="black"><?php // echo ucfirst($project_name)."'s";?> Events</font><br />-->
     <table width="100%" >
          <tr>
             <td width="100%" valign="top">
              	<input type="hidden" id="current_domain" name="current_domain" value="<?php echo $current_domain; ?>" />  
                        	<div style="float:left;margin: 0pt auto; width: 100%;height:auto !important;height:200px;min-height:200px;">
                            	<div id="blog" class="">
                                	<?php if(isset($eventdata)){
                                        if(sizeof($eventdata) > 0){
                                            foreach ($eventdata as $eachrow) { ?>
                                            <div class="blogarticle margin4px">
                                                <div class="blogtitle margin4px">
                                                <?php echo $html->link($eachrow['Event']['title'], array('controller'=>'companies', 'action'=>'iframeevent', 0, $eachrow['Event']['id']));    ?>
                                                </div>
                                                <div class="grayText margin4px">At <?php echo $eachrow['Event']['location']; ?> on <?php echo date("F d, Y", strtotime($eachrow['Event']['starttime'])); ?> | <?php echo $eachrow[0]['commentcount']; ?> Comments</div>
                                                <div class="margin4px">
                                                    <span><?php echo $eachrow['Event']['eventdescription']; ?> </span>
                                                    <span  style="float: right;"> 
                                                    
                                                    <?php echo $html->link('Read More', array('controller'=>'companies', 'action'=>'iframeevent', 0, $eachrow['Event']['id']), array('title'=>$eachrow['Event']['title'], 'class'=>'orangeText', 'style'=>'font-size: 11px;'));    ?>
                                                    </span>
                                                </div>
                                                <div class="line margin4px"><?php echo $html->image('/img/spacer.gif');?> </div>
                                            </div>
                                            <?php }
                                            if(count($eventdata)>=$eventlimit)
                                            {
                                        ?>
                                        <div style="float: right;"><a href="iframeevent/<?php echo $eventlimit+$eventoffset; ?>" id="morecomment" >More Events</a> </div>
                                        <?php
                                            }
                                        }
                                        else{
                                        ?>
                                        <div class="blogarticle margin8px" style="text-align: center;">
                                            No events found!    
                                        </div>
                                        <?php
                                        }
                                    }
                                    else{    
                                        if($eventrow){  
										
										if($is_wp){
	                                        $event_details_page   =  $eventrow['Event']['wp_event_detail_page'];
											$inquiry_details_page = $eventrow['Event']['wp_inquiry_detail_page'];
                                        }else{
											$event_details_page   = $eventrow['Event']['event_detail_page'];
											$inquiry_details_page = $eventrow['Event']['inquiry_detail_page'];
                                        }
                                        //$sponsor_details_page=AppController::getcontentsbyid($eventrow['Event']['sponsor_detail_page']);
                                        
                                         ?>
                                        <div class="margin4px" style="position: relative; width: 900px; height: 35px;font-size: 18px;"> 
                                            <div style="float: left; position: relative; width: 215px;"><b><?php echo $eventrow['Event']['title']; ?></b>
                                            <br>
                                            <?php if($username) {  ?>
                                                    <a style="cursor: pointer; font-size:14px" id="comment_click">
                                                    <?php $attrcmtimg = array('height'=>'15px', 'width'=>'25px;');
														  echo $html->image('comment_pop.png', $attrcmtimg);	?>
                                                    Comment</a> &nbsp;&nbsp;<a href=""><span class='st_sharethis' displayText='Share'></span></a>
                                        	<?php } ?>
                                            </div>
                                            
                                            <div style="float: left; position: relative; margin-left: 10px;width: 315px;">Event Type:<?php 
                                            
                                            $event_type_data=AppController::geteventtypedetails($eventrow['Event']['event_type']);
                                            echo $event_type_data['event_type'];
                                            
                                           ?> 
                                            <br>
                                             <?php if($username)
                                            {
                                                ?>
                                            <div class="margin4px">
                                            <span class="flx_button_lft_red ">
												<?php echo $form->button('RSVP', array('div'=>false,"class"=>"flx_flexible_btn_red",'style'=>'font-size:12px;','onclick'=>"window.open('".Configure::read('App.base_url')."companies/rsvp/".$eventrow['Event']['id']."','windowname1','width=750, height=450,resizable=no,scrollbars=1'); return false;"));?> 
                                             </span>&nbsp;<font size="1"><b>Please tell us if ou can attend</b></font>
                                             </div>
                                             <?php
                                            }
                                            ?>
                                            
                                            </div>
                                            
                                             <div style="float: left; position: relative; margin-left: 30px;width: auto;">
                                             <span class="flx_button_lft_blue ">
                                             <?php if($event_details_page) { echo $form->button('Details/Photos', array('div'=>false,"class"=>"flx_flexible_btn_blue",'style'=>'font-size:12px;','onclick'=>"return popitup('".$event_details_page."')")); } ?> 
                                             </span>
                                             </div>
                                             
                                              <div style="float: left; position: relative; margin-left: 10px;width: auto;">
                                             <span class="flx_button_lft ">
                                              <?php echo $form->button('Sponsor Info', array('div'=>false,"class"=>"flx_flexible_btn",'style'=>'font-size:12px;','onclick'=>"return popitup('".$sponsor_details_page."')"));?> 
                                             </span>
                                             </div>
                                             
                                             <div style="float: left; position: relative; margin-left: 10px;width: auto;">
                                             <span class="flx_button_lft_red ">
                                             <?php if($inquiry_details_page) { echo $form->button('Inquiry', array('div'=>false,"class"=>"flx_flexible_btn_red",'style'=>'font-size:12px;','onclick'=>"return popitup('".$inquiry_details_page."')")); }?> 
                                             </span>
                                             </div>
                                             
                                       </div>
                                        
                                        <div class="clear"></div>
                                         
                                            
                                        
                                       <div style="width:900px">
                                       <div style="float: left; width: 60%">
                                       <div class="margin4px" style="position: relative;  float:left; text-align: center;"> 
                                        	<a href="<?php echo $event_details_page ?>" >
                                                  <?php if($eventrow['Event']['small_pic'] !=''){ 
															$attrimg = array('height'=>'200px', 'width'=>'200px;');
															echo $html->image('project/uploads/'.$eventrow['Event']['small_pic'], $attrimg);
													 }else { ?>
                                                    <img src='/img/project/nologo.jpg' width="150px" height="150px" align="top">
                                                    <?php } ?>
                                             </a>
                                             <br/>
                                             <span>(click image for detail page)</span>
                                        </div> 
                                                                     
                                        <div class="blogarticle margin" style="float: left; position: relative; width: 50%; margin-top: 0px">
                                            <!--<div class="blogtitle margin4px"><a id="blogtitle">  
                                                <?php // echo  "Event Type:".$eventrow['Event']['event_type']; ?> </a> 
                                            </div>
                                            -->
											<ul style="list-style: none" class="contentlist">
												<li><b>Member Price:</b>&nbsp;&nbsp;$<?php echo $eventrow['Event']['member_price']; ?></li>
												<li><b>Non-Member Price:</b>&nbsp;&nbsp;$<?php echo $eventrow['Event']['non_member_price']; ?></li>
												<li><b>Location:</b> <?php echo $eventrow['Event']['location']; ?></li>
												<li><b>Address:</b> <?php echo $eventrow['Event']['address']; ?></li>
												<li><b>Date and Time:</b> <?php echo date("F j, Y", strtotime($eventrow['Event']['starttime'])); ?></li>
												<li><b>Sart Time: </b><?php echo date("F j, Y, g:i a", strtotime($eventrow['Event']['starttime'])); ?></li>
												<li><b>End Time: &nbsp;</b><?php echo date("F j, Y, g:i a", strtotime($eventrow['Event']['endtime'])); ?></li>
												<li><b>Max. Attendees:</b> <?php echo $eventrow['Event']['max_attendees']; ?> &nbsp;&nbsp;<b># Attending:</b> <?php echo $eventrow['Event']['max_attendees_start']; ?></li>
												<li><b>RSVP Required:</b><?php if($eventrow['Event']['rsvp_required']==1) echo"Yes"; else echo "No"; ?></li>
												<li></li>
											</ul>
                                              <?php if($username){
                                                  
                                              ?>
                                              <div id="leavecomment">
                                                      <form action="/companies/event_savecomment" method="post" id="event_comment_add" name="event_comment_add"> 
                                                    <div>
                                                        <label class="boldlabel">&nbsp;&nbsp;&nbsp;Leave a comment </label>
                                                        <input type="hidden" id="event_id" name="event_id" value="<?php echo  $eventrow['Event']['id']; ?>"/>
                                                    </div>
                                                    <br />
                                                    &nbsp;&nbsp;
                                                       <span class="txtArea_top">
                                                            <span class="txtArea_bot"><?php echo $form->textarea("comment", array('id' => 'comment',  'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?>
                                                             </span>
                                                       </span>
                                                    <div>&nbsp;&nbsp;&nbsp;<span class="flx_button_lft" id="savecomment">
                                                            <?php echo $form->button('Submit', array('div'=>false,"class"=>"flx_flexible_btn"));?> 
                                                        </span>
                                                        <?php // echo $form->button('Cancel', array('type'=>'Button','div'=>false,"class"=>"btn",'onclick'=>'window.location="/'.$project_name.'"'));?>
                                                    </div>
                                                     </form>  
                                                </div>
                                                <?php 
                                                
                                                }
                                                else{
                                                    ?>
                                                    <input type="hidden" id="event_id" name="event_id" value="<?php echo  $eventrow['Event']['id']; ?>"/>  
                                             <?php   }?>
                                        </div>
                                        
                                        <div class="clear"></div>
                                        
                                         <div>
                                            <b>Description:</b>
                                            <?php echo  $eventrow['Event']['eventdescription']; ?> 
                                        </div>
                                        
                                        </div>
                                        
                                        <div id="event_map" style="float: right; position: relative; width: 36%; height: auto;">
                                        <?php 
                                        if($gmkey)
                                        {
                                             echo $gm->GmapsKey(); 
                                             echo $gm->MapHolder(); 
                                             echo $gm->InitJs(); 
                                             //echo $gm->GetSideClick(); 
                                             echo $gm->UnloadMap(); 
                                        }
                                        ?>
                                        </div>
                                         <div class="clear"></div>
                                        </div>
                                        
                                        
                                        
                                         <br />
                                         <div class="margin8px" id="eventcommentlist" style="float: left; position: relative; width: 560px;">
                                                    <!-- Event Comment listing here -->
                                                 </div>
                                        
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <div class="blogarticle margin8px" style="text-align: center;">
                                            No such event data found!    
                                        </div>
                                        <?php  
                                } } ?>
                            </div>
                        </div>
                    </td>

                </tr>
            </table>

    <p>&nbsp;</p>
  </div>
  </div><p class="boxBot1">
  <?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?></p>
  
  </div>

<script type="text/javascript">


$(document).ready(function()
{
        var current_domain=$("#current_domain").val();
        var event_id=$("#event_id").val();
        $.ajax({
                   url: 'http://'+current_domain+'/companies/event_comments_by_ajax/'+event_id,
                   cache: false,
                   success: function(html){
                        $('#eventcommentlist').html(html);
                  }
        });
        
        $('#leavecomment').hide();
        
        $('#comment_click').click(function(){
        
            $('#leavecomment').show();    
        });
        
        
        $('#savecomment').click(function(){
            var current_domain=$("#current_domain").val();   
            if(trim($('#comment').val()) == '')
                {
                inlineMsg('comment','&lt;strong&gt;Please enter comment.&lt;/strong&gt;',2);
                return false;
            }else{
                   $.ajax({
                    type:'post',
                    dataType:'json',
                    cache: false,
                    data:$("#event_comment_add").serialize(),
                    url : 'http://'+current_domain + '/companies/events_savecomment',
                    success : function(res){
                        if(res= 1)
                            {    $('#eventcommentlist').hide();
                                 var event_id= $("#event_id").val();
                                  $.ajax({
                                           url: 'http://'+current_domain+'/companies/event_comments_by_ajax/'+event_id,
                                           cache: false,
                                           success: function(html){
                                                $('#eventcommentlist').html(html);
                                                $('#comment').val('');
                                                $('#eventcommentlist').slideDown(1000); 
                                          }
                                });
                        }
                        else
                            {     $('#comment').val('');  
                                  $("#errormsg").html("&lt;strong&gt;Oops! There seems to be some problem. Please try in some time.&lt;/strong&gt;");
                        }
                    }
                });
            }

        });

});
</script>
