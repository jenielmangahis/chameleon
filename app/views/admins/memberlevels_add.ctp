<?php $lgrt = $session->read('newsortingby');
	$base_url_admin = Configure::read('App.base_url_admin');
	$backUrl = $base_url_admin.'memberlevels';
?>
<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2><?php echo $pageactionname;?>Level Add/Edit</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("Admins", array("action" => "memberlevels_add",'name' => 'memberlevels_add', 'id' => "memberlevels_add",'onsubmit' => 'return validateDonationLevel("add");'));
				echo $form->hidden("MemberLevel.id", array('id' => 'id'));     
				
				?>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
				<?php e($html->image('apply.png')); ?></button>
				<button type="button" id="saveForm" class="sendBut"  onclick="javascript:(window.location='<?php echo $backUrl;?>'); "  ><?php e($html->image('cancle.png')); ?></button>
				<?php  echo $this->renderElement('new_slider');  ?>
            </div>
        </div>
        <div class="topTabs" style="height:25px;">
                <?php /*?><ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
          <li><button type="button" id="saveForm" class="button"  onclick="javascript:(window.location='<?php echo $backUrl;?>'); "  ><span> Cancel</span></button></li>
            </ul><?php */?>
        </div>
    </div>
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont">
		<?php    $this->loginarea="admins";    $this->subtabsel="levelsetup";
            echo $this->renderElement('memberlist_submenus');  ?>
    </div>
</div>
    
	
<div class="midPadd midCont clearfix">
		<div id="addcmp">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


		<!-- ADD Sub Admin FORM BOF -->
        <div class="frmbox">          
            <table class="table table-borderless" width="100%" align="left" cellpadding="3" cellspacing="3">
            
                <tr><td style="width: 15%;"align="right" valign="top"><label class="boldlabel">Level # </label></td>
                <td style="width: 85%;" colspan="3">  
                   
                    <span class="intp-Span"><?php echo $form->input("MemberLevel.level_number", array('id' => 'level_number', 'value' => $level_num, 'div' => false, 'label' => '', 'readonly' => 'readonly',"class" => "inpt-txt-fld form-control","maxlength" => "200","style" => "width: 85px"));?></span>
                    </td>
                
                 </tr>
                
            <tr><td align="right" style="width: 15%;" valign="top"><label class="boldlabel">Level Name <span class="red">*</span></label></td>
                    <td style="width: 85%;" colspan="3">
                    <span class="intp-Span"><?php echo $form->input("MemberLevel.level_name", array('id' => 'level_name', 'div' => false, 'label' => '', "class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span>
                    </td>
                </tr>
               
                <tr><td align="right" valign="top"><label class="boldlabel">Member Spending <span class="red">*</span> </label></td>
                <td style="width: 10%;" > 
                    <span class="intp-Span"><?php echo $form->input('MemberLevel.level_lowerrange', array('id' => 'level_lowerrange', 'value'=>$level_lowrange, 'div' => false, 'label' => '', 'readonly' => 'readonly',"class" => "inpt-txt-fld form-control","maxlength" => "50" ,"style" => "width: 85px"));?></span></td>
                   <td style="width: 3%;" valign="top">  To </td>  <td style="width: 60%;" ><span class="intp-Span">
                   <?php  $level_upperrange_readonly="";
                   if(isset($levelid)){
                             $level_upperrange_readonly="readonly";
                   }
                   echo $form->input('MemberLevel.level_upperrange', array('id' => 'level_upperrange', 'div' => false, 'label' => '','readonly' => $level_upperrange_readonly,'value'=>$level_upperrange,  "class" => "inpt-txt-fld form-control","maxlength" => "50","style" => "width: 85px"));?></span>
                    </td>
                    
                </tr>
             
                <tr><td align="right" valign="top"><label class="boldlabel">Note </label></td>
                    <td colspan="3"><span class="txtArea-top">
                              <span class="newtxtArea-bot">
                              <?php echo $form->textarea("MemberLevel.level_note", array('id' => 'level_note', 'div' => false, 'label' => '','cols' => '27', 'rows' => '5',"class" => "form-control noBg"));?>
                              </span></span>
                    </td>
    
                </tr>
              
                 <!-- ADD FIELD EOF -->  	
                         <!-- BUTTON SECTION BOF -->  
                         
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr><td colspan="2"><?php  echo $this->renderElement('bottom_message');  ?>     </td></tr>        
        
            </table> 
        </div>
<?php   echo $form->end();?>

					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div>  </div>
            </div><div>
<!--inner-container ends here-->

  




<div class="clear"></div>


</div><!--container ends here-->

<script type="text/javascript">

          
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcmp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
    
    function validateDonationLevel()
    {
                 if($('#level_name').val() == '')
             {
                 inlineMsg('level_name','<strong>Please provide donation level name.</strong>',2);
                 return false;
             }
             if(tagValidate($('#level_name').val()) == true){
                 inlineMsg('level_name','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
             
             if($('#level_upperrange').val() == '')
             {
                 inlineMsg('level_upperrange','<strong>Please provide donation level upper range.</strong>',2);
                 return false;
             }else{
                     var lowerrange=parseInt($('#level_lowerrange').val());    
                     var upperrange=parseInt($('#level_upperrange').val());      
                     if(lowerrange >= upperrange)  {    
                          inlineMsg('level_upperrange','<strong>Donation level upper range should be greater than lower range.</strong>',2);
                          return false; 
                     }
             }
        return true;
    }
</script>