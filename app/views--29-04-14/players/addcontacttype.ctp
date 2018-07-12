<?php
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/playerslist/'.$option;
$resetUrl = $base_url.'players/types/contact';
?>

<div class="titlCont1">
<div class="centerPage">
<?php echo $form->create("players", array("action" => "addcontacttype",'name' => 'addcontacttype', 'id' => "addcontacttype",'onsubmit' => 'return validatecontacttype("add");'));
		echo $form->hidden("ContactType.id", array('id' => 'contacttypeid')); ?>
       <div align="center" id="toppanel" >
         <?php  echo $this->renderElement('new_slider');  ?>
</div>
<?php if($usertype==trim("admin")){?>
	<span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>:&nbsp;</span>
<?php } ?>	
  <span class="titlTxt">Add Contact Type </span>
        <div class="topTabs">
                <ul>
				<?php if(isset($usertype) &&  $usertype == 'admin') { ?>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
			<?php } ?>
                <li><a href="<?php echo $backUrl ;?>"><span>Cancel</span></a></li>
                </ul>
        </div>
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