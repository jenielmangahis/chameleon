<?php
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'contacttype';
?>

<div class="titlCont1"><div style="width:960px;margin:0 auto">
<?php echo $form->create("Admins", array("action" => "editcontacttype",'name' => 'editcontacttype', 'id' => "editcontacttype",'onsubmit' => 'return validatecontacttype("edit");'))?>
       <div align="center" id="toppanel" >
      <?php  echo $this->renderElement('new_slider');  ?>
</div>

  <span class="titlTxt">Edit Contact Type </span>
        <div class="topTabs">
                <ul>
               <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>

              
                <li><a href="<?php echo $backUrl ;?>"><span>Cancel</span></a></li>
                </ul>
        </div>
</div></div>
	
<div class="midPadd">
		<div class="" style="height:300px;" id="edcnt">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


		<!-- ADD Sub Admin FORM BOF -->

		<div class="table">

		<table width=""  align="" cellpadding="1" cellspacing="1">
		<tr>
			<td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
								echo $form->error('ContactType.contact_type_name', array('class' => 'errormsg'));
							    echo $form->hidden("ContactType.id", array('id' => 'typeid'));
						?></td>
		</tr>
		<tr align="right"><td><label class="boldlabel">Contact Type <span style="color:red">*</span></label></td>
				<td> <span class="intpSpan"><?php echo $form->input("ContactType.contact_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
	    </tr>
		<!--
		<tr><td align="right"><label class="boldlabel">Project Lead</label></td>
				<td></td>
	    </tr>
		-->
		<?php 
		//echo $form->input("ContactType.project_lead", array('id' => 'project_lead', 'div' => false, 'label' => '','type'=>'checkbox'));
		echo $form->input("ContactType.project_lead", array('id' => 'project_lead', 'div' => false, 'label' => '','type'=>'hidden'));
		?>
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
	
	    </table>
<div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
           <?php  echo $this->renderElement('bottom_message');  ?>
            </div>
<?php echo $form->end();?>
					
					<!-- ADD Sub Admin  FORM EOF -->

                            </div>
				
			</div></div>

<!--inner-container ends here-->


<div class="clear"></div>


</div><!--container ends here-->

<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("edcnt").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
