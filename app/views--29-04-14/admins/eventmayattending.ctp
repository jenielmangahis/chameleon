<?php //print_r($contentid);?>

<?php
 $cancel_url="/admins/eventlist";  
	?>

<div class="titlCont"><div style="width:960px; margin:0 auto;">     
<div align="center" class="slider" id="toppanel">
        <div id="panel">
                        <div class="content clearfix">
                                <H1> Help</h1>
                                <p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
                                                        </div>
                        
        </div> <!-- /login -->  

        <!-- The tab on top --> 
        <div class="tab">
                <ul class="login">
                        <li id="toggle">
            <a id="open" class="open" href="#."><span>Click Here to Open Help Box</span></a>

                                <a id="close" style="display: none;" class="close" href="#"><span>Click Here to Close Help Box</span></a>               
                        </li>
                </ul> 
        </div>



</div>
<?php echo $form->create("Admin", array("action" => "eventattending",'name' => 'eventattending', 'id' => "eventattending")); ?>
<span class="titlTxt">
Event Memebrs  - May Be Attending
</span>
<div class="topTabs">
  <ul><li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $cancel_url;?>')"><span> Cancel</span></button></li> </ul>
</div>

<div class="clear"><img src="../../img/spacer.gif" width="1" height="12px;" /></div>
<div style="height: 30px; clear: both; margin-top: 0px; padding-left: 40px;">
<ul class="topTabs2" style="margin-left: -40px;">
<li><a href="/admins/eventinvitation/<?php echo $eventid;?>" ><span>Invite</span></a></li>
<li><a href="/admins/eventattending/<?php echo $eventid;?>" ><span>Attending</span></a></li>
<li><a href="/admins/eventmayattending/<?php echo $eventid;?>" class="tabSelt" ><span>May be Attending</span></a></li>
<li><a href="/admins/eventpending/<?php echo $eventid;?>"><span>Pending</span></a></li>
 </ul>
</div>
<div class="clear"></div>
</div>
</div>


 <div class="midCont">   

<!--inner-container starts here-->
<div class="rightpanel">

<div class="midPadd">
		 <?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
	        <div class="msgBoxBg">
		        <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
			        <?php  $session->flash();    ?> 
		        </div>
	                <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
		</div>
</div> <?php } ?>
                <div class="">
                 
<table cellspacing="10" cellpadding="0" align="center" width="100%">
                  <tbody>
            
                 <tr>
                     <td width="100%" width="100%" colspan="2"><label class="boldlabel"> <strong><?php echo $this->data['Event']['title'];?></strong> - <strong> May be Attending Members</strong></label></td>
                 </tr>
                  
                    <td width="100%" colspan="2">
                        <?php 
                         echo $form->hidden("EventInvitation.event_id", array('id' => 'eventid','value'=>"$eventid")); 
                        ?>
                       <table width="100%">
                       <tr>
                       <td width="10%">&nbsp;</td>
                       <td width="10%">&nbsp;</td>
                       <td width="10%">&nbsp;</td>
                       <td width="10%">&nbsp;</td>
                       <td width="10%">&nbsp;</td> 
                       <td width="10%">&nbsp;</td>
                       <td width="10%">&nbsp;</td>
                       <td width="10%">&nbsp;</td>
                       <td width="10%">&nbsp;</td>
                       <td width="10%">&nbsp;</td>
                       </tr>
                        <tr>  
                           <?php if($holderlist){
            $alt=0;
               $created="";   $cnt=0;
               foreach($holderlist as $eachrow){
                    
                //alternate color rows
            if($alt%2==0)
                $class="style='background-color:#FFF;'";
            else
                $class="style='background-color:#f8f8f8;'";
                
                $alt++;
               $recid = $eachrow['Holder']['id'];
               $userid = $eachrow['Holder']['user_id'];
               $modelname = "Holder";
               $othermodelname = "User";
               $redirectionurl = "eventlist";
                $screenname=$eachrow['Holder']['screenname'];
               $firstname = $eachrow['Holder']['firstname'];
               if($firstname) $firstname = AppController::WordLimiter($firstname,25);
                 $lastnameshow = $eachrow['Holder']['lastnameshow'];
                 if($lastnameshow) $lastnameshow = AppController::WordLimiter($lastnameshow,25);
               $email = $eachrow['Holder']['email'];
            if($email) $email = AppController::WordLimiter($email,30);
               $created = $eachrow['Holder']['created'];
               if($eachrow['Holder']['created'] !='0000-00-00'){
                   $created = AppController::usdateformat($eachrow['Holder']['created']);
               }
                 if($cnt > 0 && $cnt%10==0) {
                     echo "</tr> <tr>";
                 }
           ?>
                  <td width="10%" align="left" valign="top">
                  <?php if($eachrow['Holder']['avatar_url'] !=''){  ?> <img src="/<?php echo $eachrow['Holder']['avatar_url']; ?>" height="60px" width="60px"> 
                  <?php }else { ?><img src='/img/avatar/image-not-available.jpg' height="60px" width="60px"><?php } ?> <br/>
                         <span style="margin-bottom: 8px;">
                           <?php echo $screenname;?></span>
                  </td>      
               <?php    $cnt++; } } else{
                   echo "<td colspan='10'> No may be attending members </td>";
               }?>        
                       </tr>
                       
                       </table> 
                        <?php echo $form->end();?>   
                    </td>
                    </tr>
       
                </tbody>
                </table>
                

                            
                
                                        
                      
                        </div>
</div>
 
</div><!--inner-container ends here-->

  </div> 
<div class="clear"></div>