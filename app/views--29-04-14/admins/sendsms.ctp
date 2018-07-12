<script type="text/javascript">
	$(document).ready(function() {
		$('#playMnu').removeClass("butBg");
		$('#playMnu').addClass("butBgSelt");
	}); 
	function addEmailTempforTask() {   
$('#email_template_id').focus();
var resWindow=  window.open (baseUrl+'mailtasks/addsupermailcontent');
//resWindow.focus();
}
</script>
<?php 
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'admins/call/1'; ?>
<div class="container">
         <div class="titlCont">
		 <div style="width:960px; margin:0 auto;">
		  <div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">
		 <?php 
	            echo $form->create("players", array("action" => "addnote/".$option, 'name' => 'addnote', 'id' => "addnote")); 
	            echo $form->hidden("option", array('id' => 'option','value'=>"$option"));
	            echo $form->hidden("company_id", array('id' => 'companyid', 'value'=>"$current_company"));
				echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
				echo $form->hidden("project_id", array('id' => 'projectid','value'=>"$project_id"));
				echo $form->hidden("Note.id", array('id' => 'id'));
	 	   ?>
		  	
			
			<?php
			e($html->link($html->image('send.png') . ' ','sendsms/1',array('escape' => false))); ?>
			<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')">
			 <?php e($html->image('back.png')) ?>
			</button>
			
<?php //e($html->link($html->image('help.png', array('width' => '42', 'height' => '42')) . ' ','coming_soon/help',array('escape' => false)));

?>
<?php  echo $this->renderElement('new_slider');  ?>
			</div>
		  <div class="centerPage" >
          <?php /*?>  <div align="center" class="slider" id="toppanel">
                <?php  //echo $this->renderElement('new_slider');  ?>
            </div> <?php */?>           
                          
           <script type='text/javascript'>
           		function setprojectid(projectid){
                	document.getElementById('projectid').value= projectid;
                    document.adminhome.submit();
				}
           </script>            
            <span class="titlTxt1"><?php  echo $current_company_name; echo ($current_company_name !='')? ' : ' :'';  ?></span>&nbsp;
             <span class="titlTxt"><?php //echo ucfirst($option); ?> Send SMS/Text Message</span>
           <div class="topTabs" style="height:25px;">
               <?php /*?><ul>
					<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
					<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
					<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
				</ul><?php */?>
            </div> 
            <div class="clear" ></div>
			
	         <?php    $this->loginarea="admins";    $this->subtabsel="messagelist";
			
			if($_GET['url'] === 'admins/messagelist/0'){
             echo $this->renderElement('survey_submenus');
				}
				else
			if($_GET['url'] === 'admins/messagelist/1'){
             echo $this->renderElement('memberlistsecondlevel_submenus');
				}
				else
			if($_GET['url'] === 'admins/call/1' || $_GET['url']==='admins/sendsms/1'){
             echo $this->renderElement('memberlistsecondlevel_submenus');
				}
				else{
			echo $this->renderElement('memberlist_submenus');
				
				
				}?>       
                            
        </div></div>
		</div>
<div id="addcmp"  class="midCont">	
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<table cellspacing="10" cellpadding="0">
		
  <?php if($session->check('Message.flash')){ ?>
    <tr>
      <td colspan="5"><?php $session->flash(); 
      				//echo $form->error('Company.company_name', array('class' => 'msgTXt'));
      				//echo $form->error('Company.company_type_id', array('class' => 'msgTXt'));
      				
      	?></td>
    </tr>
    <?php }?>  
  
   
	<tr>
		<td valign='top' align="right"><label class="boldlabel">Text to#<span style="color:red">*</span></label></td>
		<td>
			<span class="intpSpan">
	        	<?php echo $form->input("Sendsms.text_to", array('id' => 'text_to', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
	        </span>
		</td>		 
	</tr>
	<tr>
							<td align="right"><label class="boldlabel">Select Template <span
									style="color: red;">*</span>
							</label></td>
							<td><span class="txtArea_top"> <span class="txtArea_bot"><?php echo $form->select("EmailTemplate.id",isset($template)?$template:'',null,array('id' => 'templateid','class'=>'multilist','onchange'=>'showselecttemplate(this.value)'),"---Select---"); ?>
                                         <?php echo $form->error('EmailTemplate.id', array('class' => 'errormsg')); ?> 
								</span>
							</span> </span> <span class="btnLft"><input type="button" class="btnRht"
									value="Add" name="Add" onclick="addEmailTempforTask();" />
							</span></td>
						</tr>	       
	<tr>	 
		<td valign='top' align="right"><label class="boldlabel">Text<span style="color:red">*</span></label></td>
		<td>
			<div class="large">
			<span class="txtArea_top">
				<span class="newtxtArea_bot">
					<?php echo $form->textarea("Sendsms.text", array('id' => 'text', 'div' => false, 'label' => '',
							'cols' => '35', 'rows' => '8',"class" => "multilist", 'style'=>'width:370px'));?>
				</span>
			</span>
			</div>
		</td>
	</tr>
		 <tr>
		<td valign='top' align="right"><label class="boldlabel">Attach File<span style="color:red">*</span></label></td>
		<td>
			<span class="intpSpan">
	        	<?php echo $form->input("Sendsms.attached_file", array('id' => 'subject', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "150"));?>
	        </span>
		</td>		 
	</tr>
	<tr>      
 	<?php /*?><tr>
 		<td colspan="2" style="text-align: left; padding: 20px 5px 20px 5px ;" class="top-bar">
 			<?php  echo $this->renderElement('bottom_message');  ?>
        </td>
    </tr><?php */?>
 </table>
<!--inner-container ends here-->
<?php echo $form->end();?>
</div>

 <div class="clear"></div>    
</div>   
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null){		
        document.getElementById("cmplisttab").className = "newmidCont";
    }	
</script>
<script type="text/javascript">
var correspondentRedirect = "<?php echo $correspondentRedirect;?>";
if(correspondentRedirect)
{
	window.opener.location.reload(true);
    window.close();
}
</script>