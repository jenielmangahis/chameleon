<script type="text/javascript">
$(document).ready(function() {
$('#projeCt').removeClass("butBg");
$('#projeCt').addClass("butBgSelt");
}); 
</script> 
<?php
$base_url_Admin = Configure::read('App.base_url_Admin');
$backUrl = $base_url_Admin;
?>

<div class="titlCont">
<div style="width:960px; margin:0 auto;">

<div class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
	<?php echo $form->create("Admin", array("action" => "projectcontrols",'type' => 'file','enctype'=>'multipart/form-data','name' => 'projectcontrols', 'id' => "projectcontrols"))?>
	<?php echo $form->hidden("ProjectType.id", array('id' => 'typeid'));?>	
	<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>projectdashboard')"><?php e($html->image('cancle.png')); ?></button> 
	<?php  echo $this->renderElement('new_slider');  ?>
</div>
<span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>&nbsp;</span>
<span class="titlTxt"> Controls
</span>

<div class="topTabs">
</div>
<?php    $this->loginarea="admins";    $this->subtabsel="projectcontrols";
                    echo $this->renderElement('setting_submenus');  ?> 
 </div>
 </div>   
    
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>    
<div class="midPadd" id="ProjectType">
   <div class="left" style="min-height:300px">
  <table width="800px" align="center" cellpadding="1" cellspacing="1">
							<?php if($session->check('Message.flash')){
							?><tr>
							<td colspan='3'><?php $session->flash(); 
								echo $form->error('ProjectType.project_type_name', array('class' => 'errormsg'));
										
											?></td>
							</tr>
							<?php }?>
							<tr><td><!--<label class="boldlabel">Project Type <span style="color:red">*</span></label>--></td>
									<td><?php echo $form->hidden("ProjectType.project_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></td>
							</tr>

							<tr><td valign='top'><!--<label class="boldlabel">Note </label>--></td>
									<td><?php echo $form->hidden("ProjectType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inpt_txt_fld"));?></td>
							</tr>
							<tr><td width="5%" align="center">
	<?php echo $form->input('ProjectType.istransferable', array('type'=>'checkbox', 'label' => '','onchange'=>'checkboxfun()')); ?></td>
										<td ><label class="boldlabel">Coins Held By Multiple Holders ?</label></td>
							</tr>
								<tr><td width="5%" align="center"><?php echo $form->input('ProjectType.simple_cointransfer', array('type'=>'checkbox', 'label' => '','onchange'=>'checkboxfun()')); ?></td>
										<td><label class="boldlabel">Simple Coin Transfer</label></td>
							</tr>
								
								<tr><td width="5%" align="center"><?php echo $form->input('ProjectType.registrationbox_verification', array('type'=>'checkbox', 'label' => '')); ?></td>
										<td><label class="boldlabel">RegistrationBox on Home page</label></td>
							</tr>
							<tr>
                            <?php if($this->data['Project']['is_showcoins']==1){?>
                                        <td width="5%" align="center"><?php echo $form->input('Project.is_showcoins', array('type'=>'checkbox', 'label' => '')); ?>

                                        <?php }else{ ?>
                                        
                                        <td width="5%" align="center"><?php echo $form->input('Project.is_showcoins', array('type'=>'checkbox', 'label' => '','value'=>'1')); ?>
                                        <?php }?>
                                        </td>
                                        
                            <td><label class="boldlabel">Show Coins Under Register Box</label></td>
										
								</tr>
								<tr>
                                <td width="5%" align="center"><?php echo $form->input('ProjectType.showcommentbutton', array('type'=>'checkbox', 'label' => '')); ?></td>
                                <td><label class="boldlabel">Show Comments Navigation Button</label></td>
										
							</tr>
								<!-- <tr>
                                <td width="5%" align="center"><?php echo $form->input('ProjectType.iscommentpublic', array('type'=>'checkbox', 'label' => '')); ?></td>
                                <td><label class="boldlabel">Show Comments to Everyone</label></td>
										
							</tr> -->
                            <tr>
                            <td width="5%" align="center"><?php echo $form->input('ProjectType.showpoints', array('type'=>'checkbox', 'label' => '')); ?></td>
                            <td><label class="boldlabel">Points Awarded and Tracked</label></td>
                                        
                            </tr>
                            
                            </tr>
                            <tr>
                            <td width="5%" align="center"><?php echo $form->input('ProjectType.show_top10', array('type'=>'checkbox', 'label' => '')); ?></td>
                            <td><label class="boldlabel">Turn Off Top 10 Member Dashboard</label></td>
                                        
                            </tr>
		<tr><td></td>
										
								<td>
								<?php 
										
											App::import("Model", "ProjectCommentType");
											$this->ProjectCommentType =   & new ProjectCommentType();

											$comment_type_id = $this->ProjectCommentType->find('first',array("conditions"=>"ProjectCommentType.project_type_id=$ProjectTypeId and ProjectCommentType.sequence_id=".$i." and ProjectCommentType.active_status='1' and ProjectCommentType.delete_status='0'", 'fields' =>"comment_type_id"));

											//echo $form->select("additionalcomment",$commenttypedropdown,$comment_type_id['ProjectCommentType']['comment_type_id'],array('id' => 'additionalcomment'.$i, 'div' => false, 'label' => ''),array('0'=>'--Select--'));
								
										?>
								<?php //echo $form->select("additionalcomment",array('0'=>'Misc.Additional Comment'),0,array('id' => 'additionalcomment'),false); ?></td>
							</tr>




								
							<tr><td><!--<label class="boldlabel">Default Delivery Days After Order Date</label>--></td>
										<td colspan="2"><?php echo $form->hidden("ProjectType.defaultdeliverydays", array('id' => 'defaultdeliverydays', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:40px","maxlength" => "3"));?></td>
							</tr>
								<!-- ADD FIELD EOF -->
								<!-- BUTTON SECTION BOF -->
							<tr><td colspan="3">&nbsp;</td></tr>

						
						</table>
</div>
</div>
    
    
    
    


    
    <?php echo $form->end();?>
</div>




<div class="clear"></div>

<script type="text/javascript">


		

		function hidetextboxes(){
		var i;
		var j=parseInt(document.getElementById("maxnumbercomment").options[document.getElementById("maxnumbercomment").selectedIndex].value)+1;
		for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
		{	
			document.getElementById("commenttype"+i).style.display="block";
			document.getElementById("commenttypevalue"+i).style.display="block";
		}
		if(j==1){
		for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
		{
			document.getElementById("commenttype"+i).style.display="none";
			document.getElementById("commenttypevalue"+i).style.display="none";
		}
		}else{
		for(i=j;i<=<?php echo $maxnumbercomment?>;i++)
		{
			document.getElementById("commenttype"+i).style.display="none";
			document.getElementById("commenttypevalue"+i).style.display="none";
		}
		}
		}
		//hidetextboxes();

		function checkboxfun(){
			if(document.getElementById("ProjectTypeIstransferable").checked==false)
			{document.getElementById("ProjectTypeSimpleCointransfer").checked=false;		}
		}
		function show_value()
		{
		var e = document.getElementById("additionalcomment");
		if(document.getElementById("ProjectTypeAdditionalComment").checked==true)
			{
			if(document.getElementById("additionalcomment"))
			document.getElementById("additionalcomment").style.display="block";
		}
		else
		{
			//document.getElementById("additionalcomment").selectedIndex = 0;
			document.getElementById("additionalcomment").style.display="none";
		}
		}

//window.onload=show_value;
	</script>

<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("ProjectType").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
  <!-- Body Panel ends --> 


