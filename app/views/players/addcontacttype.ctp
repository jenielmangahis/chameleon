<?php
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/playerslist/'.$option;
$resetUrl = $base_url.'players/types/contact';
?>

<div class="titlCont">
<div class="centerPage">
	<div class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align: right;">			

	   <?php echo $form->create("players", array("action" => "addcontacttype",'name' => 'addcontacttype', 'id' => "addcontacttype",'onsubmit' => 'return validatecontacttype("add");'));
		echo $form->hidden("ContactType.id", array('id' => 'contacttypeid')); ?>
		<?php if(isset($usertype) &&  $usertype == 'admin') { ?>
           <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
		<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
			<?php } ?>
              <a href="<?php echo $resetUrl ;?>"><?php e($html->image('cancle.png')); ?></a>
         <?php  echo $this->renderElement('new_slider');  ?>
</div>
<?php if($usertype==trim("admin")){?>
	<span class="titlTxt1"><?php //echo $project['Project']['project_name'];  ?>&nbsp;</span>
<?php } ?>	
  <span class="titlTxt">Add Contact Type </span>
        <div class="topTabs" style="height:25px;">
               
        </div>
		<div class="clear"></div>
		<?php    $this->loginarea="players";    $this->subtabsel= 'contact';
                            echo $this->renderElement('players/player_type_submenus');  ?>
</div></div>


	
<div class="midPadd">
		<div id="addcont" style="height:300px;">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


		<!-- ADD Sub Admin FORM BOF -->

		
		<table width="" align="" cellpadding="1" cellspacing="1">
		
		<tr><td align="right"><label class="boldlabel">Contact Type <span class="red">*</span></label></td>
				<td><span class="intpSpan"><?php echo $form->input("ContactType.contact_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
	    </tr>
		<!--
		<tr><td align="right"><label class="boldlabel">Project Lead</label></td>
				<td>
				</td>
	    </tr>
		-->	
		<?php 
				//echo $form->input("ContactType.project_lead", array('id' => 'project_lead', 'div' => false, 'label' => '','type'=>'checkbox','checked'=>true));
				echo $form->input("ContactType.project_lead", array('id' => 'project_lead', 'div' => false, 'label' => '','type'=>'hidden','value'=>0));
				?>
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2">&nbsp;</td></tr>
		
	
	    </table>

<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->
				
			</div></div>
 
</div><!--inner-container ends here-->
<div class="top-bar" style="text-align: left; padding: 5px 0px 30px 191px; ">
                          		<?php  echo $this->renderElement('bottom_message');  ?>	 

                            </div>

  




<div class="clear"></div>


</div><!--container ends here-->
<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcont").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>