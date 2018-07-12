<?php $base_url = Configure::read('App.base_url');
	$lgrt = $base_url.$session->read('newsortingby');
?>

<div class="titlCont1"><div style="width:960px;margin:0 auto">
<?php echo $form->create("Company", array("action" => "projectmembertypes_add",'name' => 'projectmembertypes_add', 'id' => "projectmembertypes_add",'onsubmit' => 'return validateMemberType("add");'));
       echo $form->hidden("MemberType.id", array('id' => 'membertypeid','value'=>"$membertypeid")); 
	   echo $form->hidden("MemberType.member_type", array('id' => 'member_type')); 
      
?>
       <div align="center" id="toppanel" >
         <?php  echo $this->renderElement('new_slider');  ?>
</div>
   
  <span class="titlTxt"><?php echo $pageactionname;?> Member Type </span>
        <div class="topTabs">
                <ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
          <li><button type="button" id="saveForm" class="button"  onclick="javascript:(window.location='<?php echo $lgrt;?>'); "  ><span> Cancel</span></button></li>
            </ul>
        </div>
</div></div>


    
	
<div class="midPadd" style="float:left;padding-left:195px;">
		<div id="addcmp" style="height:300px;">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


		<!-- ADD Sub Admin FORM BOF -->
                  
		<table width="100%" align="left" cellpadding="3" cellspacing="3">
		
		<tr><td align="right" style="width: 15%;" valign="top"><label class="boldlabel">Member Type <span class="red">*</span></label></td>
				<td style="width: 85%;"> <span class="intpSpan"><?php echo $form->input("MemberType.member_type", array('id' => 'member_type', 'div' => false, 'label' => '', 'disabled' => 'disabled',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td><td>&nbsp;</td><td>&nbsp;</td>
	        </tr>
           
            <tr><td align="right" valign="top"><label class="boldlabel">Coin Holder </label></td>
                <td><?php echo $form->input('MemberType.is_coinholder', array('type'=>'checkbox', 'label' => '','div'=>false, 'disabled' => 'disabled')); ?> </td>
            </tr>
         
            <tr><td align="right" valign="top"><label class="boldlabel">Note </label></td>
                <td><span class="txtArea_top">
                          <span class="newtxtArea_bot">
                          <?php echo $form->textarea("MemberType.note", array('id' => 'note', 'div' => false, 'label' => '','cols' => '27', 'rows' => '5',"class" => "noBg"));?>
                          </span></span>
                </td>

            </tr>
	      
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2"><?php  echo $this->renderElement('bottom_message');  ?>     </td></tr>        
	
	    </table> 
<?php echo $form->end();?>

					
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
    
    function validateMemberType()
    {
            if($('#member_type').val() == '')
             {
                 inlineMsg('member_type','<strong>Please provide member type name.</strong>',2);
                 return false;
             }
             if(tagValidate($('#member_type').val()) == true){
                 inlineMsg('member_type','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
        return true;
    }
</script>
