 <?php 
	$base_url = Configure::read('App.base_url');
		$lgrt = $base_url.$session->read('newsortingby');
?>
<div class="titlCont1"><div style="width:960px;margin:0 auto">
<?php echo $form->create("Company", array("action" => "projectdonatelevels_add",'name' => 'projectdonatelevels_add', 'id' => "projectdonatelevels_add",'onsubmit' => 'return validateDonationLevel("add");'));
if(!empty($levelid)){
	    echo $form->hidden("DonationLevel.id", array('id' => 'id','value'=>"$levelid"));     
}else{
	echo $form->hidden("DonationLevel.id", array('id' => 'id'));     
}
      
?>
       <div align="center" id="toppanel" >
         <?php  echo $this->renderElement('new_slider');  ?>
</div>
   
  <span class="titlTxt"><?php echo $pageactionname;?> Donator Level </span>
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
		
            <tr><td style="width: 15%;"align="right" valign="top"><label class="boldlabel">Level # </label></td>
            <td style="width: 85%;" colspan="3">  
               
                <span class="intpSpan"><?php echo $form->input("DonationLevel.level_number", array('id' => 'level_number', 'value' => $level_num, 'div' => false, 'label' => '', 'readonly' => 'readonly',"class" => "inpt_txt_fld","maxlength" => "200","style" => "width: 85px"));?></span>
                </td>
            
             </tr>
            
		<tr><td align="right" style="width: 15%;" valign="top"><label class="boldlabel">Level Name <span class="red">*</span></label></td>
				<td style="width: 85%;" colspan="3">
                <span class="intpSpan"><?php echo $form->input("DonationLevel.level_name", array('id' => 'level_name', 'div' => false, 'label' => '', "class" => "inpt_txt_fld","maxlength" => "200"));?></span>
                </td>
	        </tr>
           
            <tr><td align="right" valign="top"><label class="boldlabel">Donation Range </label></td>
            <td style="width: 10%;" > 
                <span class="intpSpan"><?php echo $form->input('DonationLevel.level_lowerrange', array('id' => 'level_lowerrange', 'value'=>$level_lowrange, 'div' => false, 'label' => '', 'readonly' => 'readonly',"class" => "inpt_txt_fld","maxlength" => "50" ,"style" => "width: 85px"));?></span></td>
               <td style="width: 3%;" valign="top">  To </td>  <td style="width: 60%;" ><span class="intpSpan">
               <?php 
               $level_upperrange_readonly="";
               if(!empty($levelid)){
                         $level_upperrange_readonly="readonly";
               }
               echo $form->input('DonationLevel.level_upperrange', array('id' => 'level_upperrange', 'div' => false, 'label' => '','readonly' => $level_upperrange_readonly, "class" => "inpt_txt_fld","maxlength" => "50","style" => "width: 85px"));?></span>
                </td>
                
            </tr>
         
            <tr><td align="right" valign="top"><label class="boldlabel">Note </label></td>
                <td colspan="3"><span class="txtArea_top">
                          <span class="newtxtArea_bot">
                          <?php echo $form->textarea("DonationLevel.level_note", array('id' => 'level_note', 'div' => false, 'label' => '','cols' => '27', 'rows' => '5',"class" => "noBg"));?>
                          </span></span>
                </td>

            </tr>
	      
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
                     
        <tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2"><?php  echo $this->renderElement('bottom_message');  ?>     </td></tr>        
	
	    </table> 
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