<script type="text/javascript">
$(document).ready(function() {
$('#playMnu').removeClass("butBg");
$('#playMnu').addClass("butBgSelt");
}); 
</script>
<?php
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/types/nonprofit';
$resetUrl = $base_url.'players/types/nonprofit';
?>
<div class="titlCont1">
<div class="centerPage">
<div align="center" id="toppanel" >
	 <?php  echo $this->renderElement('new_slider');  ?>

</div>
<span class="titlTxt">
 <?php if($this->data['NonProfitType']['id']){
                                                $act = 'edit';
                                                echo "Edit NonProfitType";
                                         }else{
                                                $act = 'add';
                                                echo "Add NonProfitType ";
                                         }      
                ?>
</span>
<?php echo $form->create("players", array("action" => "addnonprofittype",'name' => 'addnonprofittype', 'id' => "addnonprofittype","onsubmit"=>"return validatenonprofittype('$act');"))?>
<?php  echo $form->hidden("NonProfitType.id", array('id' => 'nonprofittypeid'));?>
<div class="topTabs">
<ul>
<?php if(isset($usertype) &&  $usertype == 'admin') { ?>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<?php } ?>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
</ul>
</div>

</div>

</div><!--rightpanel ends here-->

                            <!--inner-container starts here-->
<div id="addcnt" >    
	<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->

<div class="">	
	 <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message');  } ?>
	 
<table cellspacing="5" cellpadding="0" align="left" width="815px" style="margin-left: 50px;">
  <tbody>
    <?php if($session->check('Message.flash')){ ?>	
    <tr>
      <td colspan="5"><?php      $session->flash(); 
      				 echo $form->error('NonProfitType.non_profit_type_name ', array('class' => 'msgTXt')); 
      				 echo $form->error('NonProfitType.description', array('class' => 'msgTXt'));      				
      	?>
	
      			
      		</td>
      	
    </tr>
    <?php }?>	


     
    
<tr>
		<td width="15%"  align="right"><label class="boldlabel">Non-Profit Name <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="intpSpan"><?php echo $form->input("NonProfitType.non_profit_type_name", array('id' => 'non_profit_type_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
		</tr>    
    
<tr>
		<td width="15% " align="right" ><label class="boldlabel">Description <span style="color: red;">*</span></label></td>
			<td width="85%">
			<span class="txtArea_top">
               <span class="newtxtArea_bot">
			   	<?php echo $form->textarea("NonProfitType.description", array('id' => 'description', 'div' => false, 'label' => '',"class" => "noBg",'cols' => '35', 'rows' => '4'));?>
				</span>
			</span></td>
		</tr>    
    
     <tr>
        <td width="40% >   

    <div class="top-bar" style="margin-bottom: 10px; text-align: left; padding: 20px 5px 5px 60px; color: black;">
         <?php  echo $this->renderElement('bottom_message');  ?>
            </div>
       </td>
    </tr>
  </tbody>
</table>

					
					<!-- ADD Sub Admin  FORM EOF -->

			

 
<!--inner-container ends here-->

<?php echo $form->end();?>

		
<br>

  </div></div></div></div>
<div class="clear"></div>
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcnt").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
