<?php                                                    
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
	echo $html->css('/css/jquery_ui_datepicker');
	echo $html->css('timepicker_plug/css/style');
?>

<style type="text/css">
    .ui-datepicker-trigger{position:absolute;background:none;margin-left:5px;}
</style>
<script type="text/javascript">
    var dateobj = new Date();
    var currDate  = dateobj.getFullYear();
    $(function() {
        $('#birthday').datepicker({
            showOn: "button",
            buttonImage: baseUrl+"img/calendar_new.png",
            dateFormat: 'mm-dd-yy',
            changeMonth: true,
            changeYear:true,
            yearRange: '1890:'+ currDate
        });	

    });

    function setsubmittype(type){

        document.getElementById('submittype').value= type;
        document.holder_frm.submit();
    }
</script>
<style>
    .radio_gap{
        margin-right: 5px;
        margin-left: 5px;
    }
</style>

<!-- Body Panel starts -->
<div class="navigation">
    <div class="boxBg">      </div>
</div>

<?php echo  $form->create('Holder',array('action'=>'update_profile','enctype'=>'multipart/form-data','id'=>'SignupForm','name'=>'holder_frm','url'=>'update_profile','onsubmit' => 'return validateholder("edit");'));?>
<?php echo $form->hidden("submittype", array('id' => 'submittype','value'=>""));   ?>
<div class="bdyCont">
    <div class="boxBg1">
         <div class="boxBor1">
            <div class="boxPad">
                <div style="margin: 0pt auto; width:900px;">
                    <h2 style="float:left;">Edit </h2>
                    <div style="float: left; position: relative;width: 700px;margin-left:10px; margin-top:0px;">     
                        <div style="float:right;height: 30px;position:relative;background-color:#4f9bd7; width: auto;" class="border_shadow" id="leftmenubar_bg">
                            <?php echo $this->element("leftmenubar");?>  
                        </div>
                    </div>

                    <div style="float: left; position: relative;width: auto;margin-left:785px; margin-top:-30px;">  
                        <div style="float:right;height: 30px;position:relative;background-color:#209f20; width: auto;" class="border_shadow" id="save_apply_bg">
                            <ul class="dash_menu_opp" style="margin-left: 5px; margin-right: 3px;"> 
                                <li style="border-right:2px solid white;"><a onclick="return setsubmittype('save');"><span>Save</span></a></li>
                                <li><a onclick="return setsubmittype('apply');"><span>Apply</span></a></li>    
                            </ul>  
                        </div>
                    </div>

                    <div class="clear"></div>
                    <div class="clear"></div>
                    <div><label class='lbl'>&nbsp;<span style="color:red">&nbsp;</span></label>
                        <?php if($session->check('Message.flash')){ $session->flash(); } ?>
                    </div>
                    <div class="clear"></div>
                   <br /><br />
                   <table width="100%" cellpadding="3" cellspacing="3">
                   <tr>
                        <!-- START: Left Side Block -->  
                        <td width="55%" valign="top">
                             <table width="100%" cellpadding="3" cellspacing="3" >      
                             <tbody>
                                <tr>
                                    <td width="35%">
                                         <div class="updat">
                                            <label class="boldlabel">Screen Name <span style="color: red;">*</span></label>
                                        </div>
                                    </td> 
                                    <td width="65%">
                                        <span class="intpSpan">
                                            <?php echo $form->input('screenname',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['screenname'],'id'=>"screenname",'size'=>'40','maxlength'=>'50', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td>
                                         <div class="updat">
                                            <label class="boldlabel">First Name (Private) <span style="color: red;">*</span></label>
                                        </div>
                                    </td> 
                                    <td>
                                         <span class="intpSpan">
                                            <?php echo $form->input('firstname',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['firstname'], 'id'=>"firstname",'size'=>'40','maxlength'=>'50', 'class'=>'inptBox' )) ?>
                                         </span>
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Last Name (Private) <span style="color: red;">*</span></label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->input('lastnameshow',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['lastnameshow'], 'id'=>"lastnameshow",'size'=>'40','maxlength'=>'50', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Show My </label>
                                        </div>
                                    </td> 
                                    <td >
                                         <p>
                                         <?php echo $form->input('showfirstname', array('type'=>'checkbox', 'label' => 'First name','div'=>false, 'style'=>'margin-right:5px; margin-left:0px;')); ?>  
                                         <?php echo $form->input('shownamelast', array('type'=>'checkbox', 'label' => 'Last name','div'=>false, 'style'=>'margin-right:5px; margin-left:7px;')); ?>  
                                         </p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td width="35%">
                                         <div class="updat">
                                            <label class="boldlabel">I am a </label>
                                        </div>
                                    </td> 
                                    <td width="65%">
                                         <?php  if($holderArray['Holder']['gender']=="Male") {
                                                     $def="Male"; 
                                                }else if($holderArray['Holder']['gender']=="Female"){
                                                     $def="Female"; 
                                                }else{
                                                     $def="Not Disclosed";   
                                                }
                                                $options=array('Male'=>'Male','Female'=>'Female', 'Not Disclosed'=>'Not Disclosed');
                                                $attributes=array('legend'=>false,'default' => $def,'class'=>'radio_gap');
                                                echo $form->radio('gender',$options,$attributes);
                                        ?>
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td width="35%">
                                         <div class="updat">
                                            <label class="boldlabel">Birthday (Private) </label>
                                        </div>
                                    </td> 
                                    <td width="65%">
                                        <span class="intpSpan">
                                            <?php            
                                               if($holderArray['Holder']['birthday']!="" && $holderArray['Holder']['birthday']!="--" && $holderArray['Holder']['birthday']!="0000-00-00" && $holderArray['Holder']['birthday']!="00-00-0000" && $holderArray['Holder']['birthday']!=null){
                                               $birthdate=date("m-d-Y",strtotime($holderArray['Holder']['birthday']));
                                            }else{
                                                $birthdate="00-00-0000";
                                            }                               
                                                
                                               // $birthdate=$startdate1[1]."/".$startdate1[2]."/".$startdate1[0];
                                                echo $form->input('birthday',array('id'=>'birthday','label' => false,'div'=>false,'error'=>false,'size'=>'20','maxlength'=>'20','readonly'=>'readonly','class'=>'inptBox','type'=>'text','style'=>'width:194px;cursor:pointer;','value'=>$birthdate)); ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Show Birthday </label>
                                        </div>
                                    </td> 
                                    <td >
                                         <p>  <?php echo $form->input('showbirthmonthday', array('type'=>'checkbox', 'label' => 'Month & Day Only','div'=>false, 'style'=>'margin-right:5px; margin-left:0px;')); ?> </p>
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Phone (Private) </label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->input('phone',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['phone'], 'id'=>"phone",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                  <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Show My </label>
                                        </div>
                                    </td> 
                                    <td >
                                         <p>  <?php echo $form->input('showphone', array('type'=>'checkbox', 'label' => 'Phone','div'=>false, 'style'=>'margin-right:5px; margin-left:0px;')); ?> </p>
                                    </td>
                                </tr>
                                
                                 <tr>
                                    <td  valign="top">
                                         <div class="updat">
                                            <label class="boldlabel">Avatar </label>
                                        </div>
                                    </td> 
                                    <td  valign="top">
                                    <div style="float: left; width: 70%;">
                                        <span class="intpSpan">
                                            <?php echo $form->input('avatar',array('label'=>false,'div'=>false,'type'=>"file","name"=>"avatar",'id'=>"avatar",'size'=>'15','maxlength'=>'10', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </div> 
                                        <div style="float: right; width: 30%;"> <!-- style="margin-left: 160px;" -->
                                        <?php
                                            if($avatarArray['User']['avatar_url'])
                                            {
                                                $str=explode("/",$avatarArray['User']['avatar_url']);
                                                if($str[0]=="img"){  ?>
                                                <img src="<?php echo $this->webroot.$avatarArray['User']['avatar_url']; ?>" width="50px" height="50px" >
                                                <?php   
                                                }else{       //its facebook url       ?>       
                                                <img src="<?php echo $avatarArray['User']['avatar_url']; ?>" width="50px" height="50px">
                                                <?php 
                                                }

                                            }else{       ?>
                                            <!-- if no avatr image- show defailt -->  
                                            <img src="<?php echo $this->webroot."img/avatar/image-not-available.jpg"; ?>" width="50px" height="50px" >   
                                            <?php    }    
                                            if(isset($badge)) {      ?>
                                            <img src="<?php echo $this->webroot."img/avatar/image-not-available.jpg"; ?>" width="30px" height="30px" >   
                                            <!-- <img src="<?php echo $this->webroot.$badge; ?>" width="30px" height="30px">-->
                                        <?php }?>
                                     </div>
                                     <br/>
                                    </td>
                                </tr>
                                
                                  <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Email </label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->input('email',array('label'=>false,'div'=>false,'type'=>"text",'id'=>"email",'size'=>'40','maxlength'=>'50', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Facebook </label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->input('facebook_userid',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['facebook_userid'], 'id'=>"phone",'size'=>'40', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Twitter </label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->input('twitter_userid',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['twitter_userid'], 'id'=>"phone",'size'=>'40', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Google </label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->input('google_userid',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['google_userid'], 'id'=>"phone",'size'=>'40','class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">LinkedIn </label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->input('linked_userid',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['linked_userid'], 'id'=>"phone",'size'=>'40', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                             </tbody>
                             </table>
                        </td>
                        <!-- END : Left Side Block --> 
                        
                        <!-- START: Right Side Block -->     
                         <td width="45%" valign="top">
                             <table width="100%" cellpadding="3" cellspacing="3" >
                             <tbody>
                                <tr>
                                    <td width="35%">
                                        <div class="updat">
                                            <label class='boldlabel'>Address1</label>
                                        </div>
                                    </td> 
                                    <td width="65%">
                                           <span class="intpSpan">
                                            <?php echo $form->input('address1',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['address1'], 'id'=>"address1",'size'=>'40','maxlength'=>'200', 'class'=>'inptBox' )) ?>
                                            </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                        <div class="updat">
                                            <label class='boldlabel'>Address2</label>
                                        </div>
                                    </td> 
                                    <td >
                                           <span class="intpSpan">
                                                <?php echo $form->input('address2',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['address2'], 'id'=>"address2",'size'=>'40','maxlength'=>'200', 'class'=>'inptBox' )) ?>
                                           </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                        <div class="updat">
                                            <label class='boldlabel'>Country <span style="color: red;">*</span></label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->select("country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'inptBox dropdown_class','style'=>'width:200px;','onchange'=>'return getstateoptions(this.value,"Holder")'),"---Select---"); ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                        <div class="updat">
                                            <label class='boldlabel'>State</label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->select("state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'inptBox dropdown_class','style'=>'width:200px;'),"---Select---"); ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                        <div class="updat">
                                            <label class='boldlabel'>City</label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->input('city',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['city'], 'id'=>"city",'size'=>'40','maxlength'=>'150', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                        <div class="updat">
                                            <label class='boldlabel'>Zip/Postal Code <span style="color: red;">*</span></label>
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="intpSpan">
                                            <?php echo $form->input('zipcode',array('label'=>false,'div'=>false,'type'=>"text",'value'=>$holderArray['Holder']['zipcode'], 'id'=>"zipcode",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?>
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td >
                                         <div class="updat">
                                            <label class="boldlabel">Show My </label>
                                        </div>
                                    </td> 
                                    <td width="65%">
                                         <p>
                                         <?php echo $form->input('showaddress1', array('type'=>'checkbox', 'label' => 'Address1','div'=>false, 'style'=>'margin-right:5px; margin-left:0px;')); ?>  
                                         <?php echo $form->input('showaddress2', array('type'=>'checkbox', 'label' => 'Address2','div'=>false, 'style'=>'margin-right:5px; margin-left:7px;')); ?>  
                                         <?php echo $form->input('showcity', array('type'=>'checkbox', 'label' => 'City','div'=>false, 'style'=>'margin-right:5px; margin-left:7px;')); ?>  
                                         </p>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td  valign="top">
                                        <div class="updat">
                                            <label class='boldlabel'>My Description (<small>Members Only</small>)</label>  
                                        </div>
                                    </td> 
                                    <td >
                                        <span class="txtArea_top" style="width: 236px;">
                                            <span class="newtxtArea_bot">
                                                <?php echo $form->textarea("member_description", array('id' => 'member_description', 'div' => false, 'label' => '','cols' => '27', 'rows' => '8',"class" => "noBg"));?>
                                            </span>
                                        </span>                 
                                    </td>
                                </tr>
                                
                                  <tr>
                                    <td colspan="2">
                                        &nbsp;
                                    </td> 
                                  </tr>
                                <tr>
                                    <td  valign="top">
                                        &nbsp;
                                    </td> 
                                    <td valign="middle" align="center">
                                        <span class="flx_button_lft ">
                                            <input type="button" id="email_preferences" value="Email Preferences" class="flx_flexible_btn"> 
                                        </span>
                                    </td>
                                </tr>
                                
                                        
                             </tbody>
                             </table>
                        </td>
                        <!-- END: Right Side Block -->   
                   </tr>
                   </table>
                   
                  <br />


                    <table style="border:2px solid #e8e8e8;" width="100%" class="border_shadow">
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                &nbsp;&nbsp;&nbsp;<font size="+2" class="update_profile_header">Change Password</font><br />
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>

                        <tr>
                            <td widht="50%">
                                <div class="updat">
                                    <label class='boldlabel'>&nbsp;Current Password</label>
                                </div>
                                <span class="intpSpan">
                                    <?php echo $form->input('cur_pass',array('label'=>false,'div'=>false,'type'=>"password",'id'=>"cur_pass",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?>
                                </span>
                            </td>
                            <td widht="50%">
                                <div class="updat1">
                                    <label class='boldlabel'>New Password</label>
                                </div>
                                <span class="intpSpan">
                                    <?php echo $form->input('new_pass',array('label'=>false,'div'=>false,'type'=>"password",'id'=>"new_pass",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?>
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td widht="50%">
                                &nbsp;
                            </td>
                            <td widht="50%">
                                <div class="updat1">
                                    <label class='boldlabel'>Confirm Password</label>
                                </div>
                                <span class="intpSpan">
                                    <?php echo $form->input('confirm_pass',array('label'=>false,'div'=>false,'type'=>"password",'id'=>"confirm_pass",'size'=>'40','maxlength'=>'10', 'class'=>'inptBox' )) ?>
                                </span>
                            </td>
                        </tr>


                    </table>

                    <?php echo $form->end();?>

                </div>
            </div>
        </div><p class="boxBot1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_bot.gif', array('class'=>'right'));?>
        </p>

    </div>
  </div>
  <div class="clear"></div>
  <!-- Body Panel ends --> 


<script type="text/javascript">


$(document).ready(function()
{
    $('#email_preferences').click(function(){   
                  window.location = "/companies/email_subscriptions"
    });
});

</script>