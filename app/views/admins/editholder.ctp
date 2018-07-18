<?php $lgrt = $session->read('newsortingby');
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'memberlist';
    $coinHolder = $this->params['pass'][0];
    //echo $javascript->codeBlock("var coinHolder = $coinHolder");
?>
<?php
    echo $javascript->link('datetimepicker/jquery-ui-1.8.custom.min.js');
	echo $html->css('/css/jquery_ui_datepicker');
   echo $html->css('timepicker_plug/css/style');

?>
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/timepicker_plug/css/style.css">
<link rel="stylesheet" type="text/css" href="/js/datetimepicker/smothness/jquery_ui_datepicker.css">
<style type="text/css">
    .ui-datepicker-trigger{position:absolute;background:none;margin-left:5px;}
</style>
<!--container starts here-->
<div class="midCon">
  <div class="titlCont">
    <div style="width:960px; margin:0 auto;">
     <div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
        
		
		<?php 
                echo $form->create("Admin", array("action" => "editholder/$recordid",'type' => 'file','enctype'=>'multipart/form-data','name' => 'editholder', 'id' => "editholder"));
            ?>
      
		<?php
		
$ids = $this->params['pass'][0]; 
e($html->link($html->image('call.png', array('alt' => 'New')) . ' ' . __(''), $base_url_admin."call/h/".$ids,array('escape' => false)));

e($html->link($html->image('email.png', array('alt' => 'Email')) . ' ' . __(''), $base_url_admin."sendtempmail/".$ids,array('escape' => false)));

e($html->link($html->image('sms.png', array('alt' => 'Sms')) . ' ' . __(''), $base_url_admin."sendsms/1",array('escape' => false)));


e($html->link($html->image('message.png', array('alt' => 'Message')) . ' ' . __(''), $base_url_admin."messagenew/".$ids,array('escape' => false)));

e($html->link($html->image('event.png', array('alt' => 'Event')) . ' ' . __(''), $base_url_admin."appointment/".$ids,array('escape' => false)));

e($html->link($html->image('note.png', array('alt' => 'Note')) . ' ' . __(''), "../players/notelist/2",array('escape' => false)));

e($html->link($html->image('take.png', array('alt' => 'Task')) . ' ' . __(''), array('controller'=>'offers','action'=>'tasklist'),array('escape' => false))); ?>

	
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
	<?php e($html->image('save.png', array('alt' => 'Save'))) ?>
</button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
	<?php e($html->image('apply.png', array('alt' => 'Apply'))) ?>
</button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')">
<?php e($html->image('cancle.png', array('alt' => 'Cancle'))) ?>
</button>

<?php //e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ' . __(''), $base_url_admin."coming_soon/help",array('escape' => false)));

?>
<?php  echo $this->renderElement('new_slider');  ?>
		</div>
      
      <span class="titlTxt">Edit Contact Info </span>
      <div class="topTabs" style="height:25px;">
        <?php /*?><li> <ul>
         
            <button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button>
          </li>
          <li>
            <button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button>
          </li>
          <li>
            <button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button>
          </li>
        </ul><?php */?>
      </div>
      <?php    $this->loginarea="admins";    $this->subtabsel="details";
                   echo $this->renderElement('memberlistsecondlevel_submenus');  ?>
    </div>
  </div>
  <!--inner-container starts here-->
  <div class="midPadd">
    <script type="text/javascript">
            /* <![CDATA[ */
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
            /* ]]> */
        </script>
    <style>
			.lods tr td table tr td {
  display: block;
  float: left;
  padding: 0 !important;
  width: 230px;
}
.lods tr td table tr td label{line-height: 24px;}
.lods tr td table tr td div label{line-height: normal;}
		</style>
    <div class="lods"> <br>
      <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
      <table width="100%" cellpadding="3" cellspacing="3" style="margin-top:-10px;">
        <tbody>
        
        <tr>
        
        <td width="50%" valign="top" >
        
        <!-- START : LEFT SIDE CONTENT -->
        <table cellspacing="10" cellpadding="3"   width="100%" >
          <tbody>
            <tr>
              <td colspan="2"><?php if($session->check('Message.flash')){ $session->flash(); } 
                                                echo $form->hidden("Holder.id", array('id' => 'holderid'));
                                                echo $form->hidden("User.id", array('id' => 'userid','value'=>"$userid"));
												echo $form->hidden("User.password", array('id' => 'userpwd','value'=>"$userpwd"));
                                                echo $form->error('User.password', array('class' => 'errormsg'));
                                                echo $form->error('Holder.screenname', array('class' => 'errormsg'));
                                                echo $form->error('Holder.firstname', array('class' => 'errormsg')); 
                                                echo $form->error('Holder.lastnameshow', array('class' => 'errormsg'));
                                                echo $form->error('Holder.country', array('class' => 'errormsg'));
                                            ?>
              </td>
            </tr>
            <tr>
              <td align="right"  ><label class="boldlabel">First Name <span style="color:red">*</span></label></td>
              <td >
                <span class="intpSpan"> <?php echo $form->input("Holder.firstname", array('id' => 'firstname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
            </tr>
            <tr>
              <td  align="right"><label class="boldlabel">Last Name<span style="color:red">*</span></label></td>
              <td >
                <span class="intpSpan"> <?php echo $form->input("Holder.lastnameshow", array('id' => 'lastnameshow', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
            </tr>
            <tr>
              <td align="right" ><label class="boldlabel">Member Type</label>
              </td>
              <td><span class="txtArea_top"> <span class="txtArea_bot">
                <?php 
echo $form->select("Holder.member_type",$MemberTypeList,$sel_member_type, array('id' => 'member_type',   'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");
                                                ?>
                </span> </span> </td>
            </tr>
            <tr>
              <td  align="right"><label class="boldlabel">Email <span style="color:red">*</span></label></td>
              <td ><span class="intpSpan">
                <?php 
$email = $this->data['Holder']['email'];
echo $form->input("Holder.email", array('id' => 'email', 'value'=>$email, 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => ""));?>
                </span></td>
            </tr>
            <tr>
              <td  align="right" valign="top"><label class="boldlabel">Avatar </label></td>
              <td ><div style="float: left; width: 80%;"> <span class="intpSpan"> <?php echo $form->file('avatar',array('id'=> 'avatar','name'=> 'avatar',"class" => "inpt_txt_fld1","size"=>"13", 'style' => 'width: 165px; vertical-align: middle;'));?> </span> </div>
                <div style="float: right; width: 20%;">
                  <!-- style="margin-left: 160px;" -->
                  <?php
                                            if($avatarArray['User']['avatar_url'])
                                            {
                                                $str=explode("/",$avatarArray['User']['avatar_url']);
                                                if($str[0]=="img"){  ?>
												
                 <img src="<?php echo $this->webroot.$avatarArray['User']['avatar_url']; ?>" width="50px" height="50px" >
                  <?php   
                                                }else{       //its facebook url       ?>
												
                 <img src="<?php echo $avatarArray['User']['avatar_url']; ?>" width="50px" height="50px">
                  <?php  }
				  }else{  ?>
						<?php e($html->image('avatar/image-not-available.png', array('alt' => 'image-not-available'))) ?>
                  <!-- if no avatr image- show defailt 
                  <img src="<?php //echo $this->webroot."img/avatar/image-not-available.jpg"; ?>" width="50px" height="50px" >-->
                  <?php    }    
                                            if(isset($badge)) {      ?>
											<?php e($html->image('avatar/image-not-available.png', array('alt' => 'Image Not Found'))) ?>
                 <!--  <img src="<?php //echo $this->webroot."img/avatar/image-not-available.jpg"; ?>" width="30px" height="30px" >
                  <img src="<?php echo $this->
                  webroot.$badge; ?>" width="30px" height="30px">-->
                  <?php }?>
                </div>
                <br/>
              </td>
            </tr>
            <tr>
              <td  align="right"><label class="boldlabel">Address1</label></td>
              <td >
                <span class="intpSpan"> <?php echo $form->input("Holder.address1", array('id' => 'address1', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
            </tr>
            <tr>
              <td align="right" ><label class="boldlabel">Address2</label></td>
              <td >
                <span class="intpSpan"> <?php echo $form->input("Holder.address2", array('id' => 'address2', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
            </tr>
            <tr>
              <td align="right"><label class="boldlabel">Country <span style="color:red">*</span></label>
              </td>
              <td><span class="txtArea_top"><span class="txtArea_bot"> <?php echo $form->select("Holder.country",$countrydropdown,$selectedcountry,array('id' => 'country','class'=>'multilist','onchange'=>'return getstates(this.value,"Holder")'),array('254'=>'United States')); ?></span></span> </td>
              <td><?php echo $form->error('Holder.country', array('class' => 'errormsg')); ?> </td>
            </tr>
            <tr>
              <td align="right"><label class="boldlabel">State</label>
              </td>
              <td><span class="txtArea_top"><span class="txtArea_bot"> <span id="statediv"> <?php echo $form->select("Holder.state",$statedropdown,$selectedstate,array('id' => 'state','class'=>'multilist'),"---Select---"); ?></span> </span> </td>
            </tr>
            <tr>
              <td align="right" ><label class="boldlabel">City</label></td>
              <td >
                <span class="intpSpan"> <?php echo $form->input("Holder.city",array('id' => 'city', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150")); ?></span></td>
            </tr>
            <tr>
              <td align="right" ><label class="boldlabel">Zip/Postal Code <span style="color:red">*</span></label></td>
              <td >
                <span class="intpSpan"> <?php echo $form->input("Holder.zipcode", array('id' => 'zipcode', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
            </tr>
            <tr>
              <td align="right" ><label class="boldlabel">Phone <span style="color:red">*</span></label></td>
              <td >
                <span class="intpSpan"> <?php echo $form->input("Holder.phone", array('id' => 'phone', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => ""));?></span></td>
            </tr>
            <tr>
              <td align="right"><label class="boldlabel">Gender</label></td>
              <td  >
                <?php  
                                                $sel_gender='Not Disclosed';
                                                if($this->data['Holder']['gender']!="" || $this->data['Holder']['gender']!=null){
                                                    $sel_gender=$this->data['Holder']['gender'];
                                                }
                                            echo $form->radio("Holder.gender", array('Male'=>'Male','Female'=>'Female', 'Not Disclosed'=>'Not Disclosed'), array('default'=>$sel_gender,'id'=>'gender', 'legend'=>false,'style'=>'margin-right:7px; margin-left:5px;','class'=>'change_rel_type')); ?>
              </td>
            </tr>
            <tr>
              <td align="right" ><label class="boldlabel">Birthday</label></td>
              <td >
                <span class="intpSpan">
                <?php 
                                              if($this->data['Holder']['birthday']!="" && $this->data['Holder']['birthday']!="--" && $this->data['Holder']['birthday']!="0000-00-00" && $this->data['Holder']['birthday']!="00-00-0000" && $this->data['Holder']['birthday']!=null){
                                                    $dateFormat = explode('-',$this->data['Holder']['birthday']);
                                                    $birthDate = $dateFormat[1].'-'.$dateFormat[2].'-'.$dateFormat[0];
                                                    $this->data['Holder']['birthday'] = $birthDate;
                                             }else{
                                                    $birthDate="00-00-0000";
                                             }                                 

                                                echo $form->text("Holder.birthday", array('id' => 'birthday', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "20",'readonly'=>'readonly','style'=>'width:200px','value'=>$birthDate));?>
                <!--  &nbsp; <input type="button" class="calendarcls" id="birthdayBP"></span>-->
              </td>
            </tr>
            <?php 
                                    if($userSubscriptionTypes) { $itemCnt=0;
                                        $selectedTypes=array();
                                        $selectedTypes=explode(",", $this->data['Holder']['subscription_type_id']);
                                    ?>
            <tr>
              <?php    foreach($userSubscriptionTypes as $typeid=>$type){
                                                if(in_array($typeid, $selectedTypes)){
                                                    $chk='checked="checked" ';
                                                }else{
                                                    $chk='';
                                                }
                                                if($itemCnt==2) {
                                                    echo " </td></tr><tr>";
                                                    $itemCnt=0;
                                                }
                                                if($itemCnt==0){
                                                ?>
              <td  align="right"><div>
                  <label class="boldlabel"> <?php echo $type;  ?> </label>
                </div></td>
              <td style=" padding: 0 95px 0 0;"><div style="width: 10px; float: left; text-align: left;">
                  <input class="subscription_type_checks" type="checkbox" <?php echo $chk;?> name="data[Holder][subscription_type_id][]" value="<?php echo $typeid;?>" >
                </div>
                <?php  }else if($itemCnt==1){ ?>
                <div style="width: 219px; float: right; text-align: right;">
                  <label class="boldlabel" style="padding-right: 2px"><?php echo $type;  ?> </label>
                  <input type="checkbox" class="subscription_type_checks" <?php echo $chk;?> name="data[Holder][subscription_type_id][]" value="<?php echo $typeid;?>" >
                </div>
                <?php  } ?>
                <?php    $itemCnt++;   } ?>
				                 <td width="55%" align="right"><label class="boldlabel">Direct Mail Only </label></td>
                                        <td width="45%"><?php echo $form->input('Holder.is_direct_email', array('type'=>'checkbox','id'=>"is_direct_email" , 'label' => '','div'=>false)); ?></td>


                               
            </tr>
            <?php  }?>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
			<tr><td colspan='2' style="border-left: 0px none; text-align: left; padding-top: 5px; " class="top-bar">
                                            <?php  echo $this->renderElement('bottom_message');  ?>   
                                        </td></tr>
            <!--<tr>
                                        <td width="55%" align="right"><label class="boldlabel">Direct Mail Only </label></td>
                                        <td width="45%"><?php echo $form->
          input('Holder.is_direct_email', array('type'=>'checkbox','id'=>"is_direct_email" ,'label' => '','div'=>false)); ?>
          </td>
          
          -->
          </tr>
          
          <!--           
								 <tr>
                                        <td align="right"  ><label class="boldlabel">Company</label></td>
                                        <td ><label for="project_name"></label><span class="intpSpan">
                                            <?php echo $form->
          input("Holder.company", array('id' => 'company', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
          </span>
          </td>
          
          </tr>
          
          <tr>
            <td  align="right"><label class="boldlabel">Title </label></td>
            <td ><label for="project_name"></label>
              <span class="intpSpan"> <?php echo $form->input("Holder.title", array('id' => 'title', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
          </tr>
          -->
          </tbody>
          
        </table>
        <!-- END : LEFT SIDE CONTENT -->
        </td>
        
        <td width="50%" valign="top" ><!-- START : RIGHT SIDE CONTENT -->
            <table  width="100%" cellspacing="10" cellpadding="3">
              <?php /*?><tr>
                <td align="right" ><label class="boldlabel">Member Level</label>
                </td>
                <td><span class="txtArea_top"> <span class="txtArea_bot">
                  <?php 
                                                    echo $form->select("Holder.member_level",$memberevelDown,$sel_member_label, array('id' => 'member_lebel',   'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");
                                                ?>
                  </span> </span> </td>
              </tr><?php */?>
              <tr>
                <td  valign='top' class="lbltxtarea" align="right" ><label class="boldlabel">Member Description </label></td>
                <td><span class="txtArea_top"> <span class="newtxtArea_bot"><?php echo $form->textarea("Holder.member_description", array('id' => 'member_description', 'div' => false, 'label' => '','cols' => '27', 'rows' => '5',"class" => "noBg"));?></span></span></td>
              </tr>
              
              <tr>
                <td align="right" ><label class="boldlabel">Facebook</label></td>
                <td >
                  <span class="intpSpan"> <?php echo $form->input("Holder.facebook_userid", array('id' => 'facebook_userid', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
              </tr>
              <tr>
                <td align="right" ><label class="boldlabel">Twitter</label>
                  &nbsp;</td>
                <td >
                  <span class="intpSpan"> <?php echo $form->input("Holder.twitter_userid", array('id' => 'twitter_userid', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
              </tr>
              <tr>
                <td align="right" ><label class="boldlabel">Google</label>
                  &nbsp;</td>
                <td >
                  <span class="intpSpan"> <?php echo $form->input("Holder.google_userid", array('id' => 'google_userid', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
              </tr>
              <tr>
                <td align="right" ><label class="boldlabel">LinkedIn</label>
                  &nbsp;</td>
                <td >
                  <span class="intpSpan"> <?php echo $form->input("Holder.linked_userid", array('id' => 'linked_userid', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
              </tr>
              <tr>
                <td align="right" ><label class="boldlabel">Pinterest</label>
                  &nbsp;</td>
                <td >
                  <span class="intpSpan"> <?php echo $form->input("Holder.pintrest", array('id' => 'pintrest', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "10"));?></span></td>
              </tr>
			  <tr>
					<td align="right" width="40%" class="lbltxtarea">
						<label class="boldlabel">Non Profit</label>
						<div  style="margin:7px 5px 0 0;">
							<span class="btnLft">
								<input type="button" value="View" tabindex=14 id="view_contact" class="btnRht" name="view" onclick="viewplayernonprofit();"  />
							</span>							
						</div>
					</td>
					<td width="85%">
						<div>
							<span class="txtArea_top">
								<span class="newtxtArea_bot">
									<?php echo $form->select("NonProfit.id",$playerNonProfitDropdown,$membernonprofitids,array('id' => 'nonprofit_id','class'=>'multilist','multiple'=>'multiple')); ?>					
								</span>
							</span>
						</div>
						
					</td>
			   </tr>
			  <tr>
                                    <td  valign='top' class="lbltxtarea" align="right" ><label class="boldlabel">Donation Level </label>  </td>
                                    <td>
                                    <span class="txtArea_top">
                                            <span class="txtArea_bot">
                                                <?php 
                                                    echo $form->select("Holder.donation_level",$projectdonationlevel,null,array('id' => 'donation_level', 'div' => false, 'label' => '','style' =>'background: none repeat scroll 0% 0% transparent; margin-bottom: 6px; width:230px;',"class" =>"","maxlength" => "250"),"---Select---");
                                                ?>
                                            </span>
                                        </span>
                                        
                                    </td>
                                   </tr>
			  <tr>
                <td align="right" width="40%" class="lbltxtarea"><label class="boldlabel">Coins</label>
				<div  style="margin:7px 5px 0 0;"> <span class="btnLft">
                    <input type="button" value="View" tabindex=14 id="view_coins" class="btnRht" name="view" onclick="viewcoins();"  />
                    </span> <span  class="btnLft">
                    <input type="button" value="Add" name="Add" tabindex=15 class="btnRht" ONCLICK="addnewcoin()"/>
                    </span> </div>
                </td>
                <td width="85%"><div> <span class="txtArea_top"> <span class="newtxtArea_bot">
				<?php echo $form->select("Coins.id",$coinsetdtlDropdownss,$selectedcoins,array('id' => 'coins_id','class'=>'multilist','multiple'=>'multiple')); ?>
				 <?php //echo $form->select("Coins.id",$coinsetdtlDropdown,$selectedcoins,array('id' => 'coins_id','class'=>'multilist','multiple'=>'multiple')); ?> </span> </span> </div>
                  </td>
              </tr>
              <tr>
                <td align="right" ><label class="boldlabel">Screen Name <span style="color:red">*</span></label></td>
                <td >
                  <span class="intpSpan"> <?php echo $form->input("Holder.screenname", array('id' => 'screenname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?></span></td>
              </tr>
              <tr>
                <td  align="right" valign="top"><label class="boldlabel">Show </label></td>
                <td><p> <?php echo $form->input('Holder.showfirstname', array('type'=>'checkbox', 'label' => '','div'=>false, 'style'=>'margin-right:5px; margin-left:0px;')); ?> First name <?php echo $form->input('Holder.shownamelast', array('type'=>'checkbox', 'label' => '','div'=>false, 'style'=>'margin-right:5px; margin-left:7px;')); ?> Last name </p>
                  <p> <?php echo $form->input('Holder.showaddress1', array('type'=>'checkbox', 'label' => '','div'=>false, 'style'=>'margin-right:5px; margin-left:0px;')); ?> Address1 <?php echo $form->input('Holder.showaddress2', array('type'=>'checkbox', 'label' => '','div'=>false, 'style'=>'margin-right:5px; margin-left:14px;',)); ?> Address2 </p>
                  <p> <?php echo $form->input('Holder.showcity', array('type'=>'checkbox', 'label' => '','div'=>false, 'style'=>'margin-right:5px; margin-left:0px;',)); ?> City <?php echo $form->input('Holder.showphone', array('type'=>'checkbox', 'label' => '','div'=>false, 'style'=>'margin-right:5px; margin-left:45px;')); ?> Phone </p></td>
              </tr>
              <tr>
                <td colspan='0' style="border-left: 0px none; text-align: right; padding-top: 5px; " class="top-bar"><?php  //echo $this->renderElement('bottom_message');  ?>
                </td>
                <td></td>
              </tr>
              <tr>
                <td colspan='2'>&nbsp;</td>
              </tr>
            </table>
            <!-- END : RIGHT SIDE CONTENT -->
          </td>
        </tr>
        </tbody>
        
      </table>
      <!-- ADD Sub Admin  FORM EOF -->
    </div>
  </div>
  <!--inner-container ends here-->
  <?php echo $form->end();?>
  <div class="clear"></div>
</div>
<script type="text/javascript">


$(document).ready(function()
{

        
         if($('#is_direct_email').is(":checked"))  {  
                    $(".subscription_type_checks").removeAttr("checked");
                    $(".subscription_type_checks").attr("disabled", true); 
         }else{       
                    $(".subscription_type_checks").removeAttr("disabled");   
         }
        
           
        $('#is_direct_email').click(function(){
               
               if($(this).is(":checked"))  {  
                    $(".subscription_type_checks").removeAttr("checked");
                    $(".subscription_type_checks").attr("disabled", true); 
               }else{       
                    $(".subscription_type_checks").removeAttr("disabled");   
               }
                
       });
});
</script>
