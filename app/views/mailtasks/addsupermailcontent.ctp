<script type="text/javascript">
$(document).ready(function() {
$('#EmailMnu').removeClass("butBg");
$('#EmailMnu').addClass("butBgSelt");
}); 
</script> 

<?php 
/*$server_path=$_SERVER['REQUEST_URI'];
$server_para=explode('/',$server_path);
$id=$server_para[3];
*/
if(!empty($this->params['pass']['0'])){
	$id=$this->params['pass']['0'];
}else{
	$id='';
}

?>
<?php 
$baseUrlAdmin = Configure::read('App.base_url_admin');
$backurl = $baseUrlAdmin.'help_list';
?>
<?php $lgrt = $session->read('newsortingby');?>

<!-- Body Panel starts -->
<div class="titlCont"><div class="myclass">
<div class="slider" id="toppanel" style="height: 20px; top:13px;right:0px;width:545px !important; text-align:right;">
<?php 
 echo $javascript->link('ckeditor/ckeditor');

 
 echo $form->create("mailtasks", array("action" => "addsupermailcontent",'name' => 'addmailtemplate', 'id' => "addsupermailcontent","onsubmit"=>"return validatemailcontent('add');")); 
  if($returnurl){ echo $form->hidden("returnurl", array('id' => 'returnurl', 'value'=>$returnurl)); }
  if($closeit=="yes"){   echo $form->hidden("closeit", array('id' => 'closeit', 'value'=>$closeit)); }
     echo $form->hidden("EmailTemplate.id", array('id' => 'templateid'));   
  
 ?>
 <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  <?php if($returnurl){ echo "onclick='closemywindow();'"; }else{?>ONCLICK="Backurlsupermailcontent()" <?php } ?>><?php e($html->image('cancle.png')); ?></button>
         <?php  echo $this->renderElement('new_slider');  ?>



</div>

<span class="titlTxt">Add New Template
</span>


<div class="topTabs" style="height:25px;">

</div>
  <?php $this->subtabsel="mailtemplatelist";   echo $this->renderElement('emails_submenus');?>    	
</div></div>

<div class="midPadd" id="mailtmp">

<div class="boxBor1">
       
             <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<div class="clear"></div>
</div>
<br/>
	<div class="boxBor1">
          
                <table cellspacing="5" cellpadding="0" align="center" width="100%">
                  <tbody>
                   <?php if($session->check('Message.flash')){ ?>
		    <tr>
                      <td colspan="2"><?php  $session->flash(); 
                                         echo $form->error('EmailTemplate.email_template_type', array('class' => 'errormsg'));
										echo $form->error('EmailTemplate.email_template_name', array('class' => 'errormsg'));
                                    echo $form->error('EmailTemplate.content', array('class' => 'errormsg'));
                                echo $form->error('EmailTemplate.sender', array('class' => 'errormsg'));
								
                                ?></td>
                    </tr>
		  <?php }?>
		  
		  			 <tr>
                         <td width="16%" align="right"><label class="boldlabel">Relationship Type <span class="red">*</span></label></td>
                                   
								<td width="85%" valign="top">

								<span class="txtArea_top"><span class="txtArea_bot"><span id="compdiv">	
		<?php echo $form->select("EmailTemplate.email_template_type",$templatetypedropdown,$selectedtemplatetype, array('id' => 'email_template_type', 'div' => false, 'label' => '',"class" =>"multilist","maxlength" => "250"),"---Select---"); ?>
								</span></span></span>
							
								</td>
								
                    </tr>
					
		  				
                    <?php if($id){ ?>
                    <tr>
                         <td width="16%" align="right"><label class="boldlabel">Template Name <span class="red">*</span></label></td>
                                   
								<td width="85%" valign="top">
								<span class="intpSpan">
											<?php echo $form->input("EmailTemplate.email_template_name", array('id' => 'email_template_name', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250",'disabled'=>true,'value'=>$this->data['EmailTemplate']['email_template_name']));?>
										</span>
							
								</td>
								
                    </tr>
                    <?php }else{ ?>
                    <tr>
                     <td width="16%" align="right"><label class="boldlabel">Template Name <span class="red">*</span></label>&nbsp;</td>
					 <td width="85%">
										<span class="intpSpan">
											<?php echo $form->input("EmailTemplate.email_template_name", array('id' => 'email_template_name', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250",'value'=>$this->data['EmailTemplate']['email_template_name']));?>
										</span>
								</td>
                     
                    </tr>
                    <?php } ?>
                   
                    <tr>
                     <td width="15%" align="right"><label class="boldlabel">Subject <span class="red">*</span></label></td>
                     <td width="85%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.subject", array('id' => 'subject', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
                    </tr>
                   <?php /* ?>
				   <tr>
                     <td width="15%" align="right"><label class="boldlabel">Sender </label></td>
                     <td width="85%"><span class="intpSpan"><?php echo $form->input("EmailTemplate.sender", array('id' => 'sender', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250", ));?></span></td>
                    </tr>
                    <?php */ ?>
					<tr>
                                         <td width="15%" style="vertical-align:top;"  align="right"><label class="boldlabel">Content <span class="red">*</span></label></td>
                      <td width="85%">
                                  <span id="content_label" >&nbsp;</span></td>
                     </tr>
                    <tr>

			<td colspan=2>
                        <?php //echo $form->textarea("EmailTemplate.content", array('id' => 'content', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "inpt_txt_fld"));?>
                        <?php   
                                                /*echo $form->create('EmailTemplate');  
                                                echo $form->input('content', array('cols' => '100', 'rows' => '100','label'=>false,'div'=>false,'class'=>'inpt_txt_fld','style'=>"width:400px")); 
                                                echo $fck->load('EmailTemplate/content','490','600'); 
                                                echo $form->input('id', array('type'=>'hidden'));*/                                             
                                                echo $form->textarea('EmailTemplate.content', array('id'=>'content','class'=>'ckeditor'));
                        ?>
                      
							<script type="text/javascript">
							  //var ck_newsContent = CKEDITOR.replace('content',{filebrowserBrowseUrl : '<?php echo $ckfinderPath; ?>',filebrowserWindowWidth : '800',filebrowserWindowHeight : '700'});
							  </script>
                        </td>
                    </tr>       
                        
                    <tr><td colspan="2">&nbsp;</td></tr>
                
                </tbody>
                </table>
        <div style="margin-bottom: 10px ; text-align: left; color:black" class="top-bar">
 <?php  echo $this->renderElement('bottom_message');  ?>   </div>

</div></div> </div>
 
<!--inner-container ends here-->

  
<div class="clear"></div>
  <!-- Body Panel ends -->
        <?php echo $form->end();?>

<div class="clear"></div> 
<script type="text/javascript">
     $(document).ready(function(){
     
           if($("#closeit")){
               isclose=$("#closeit").val();
               if(isclose=="yes"){
                   // This function from `Parent window i.e formtype_add`
                    window.opener.GetEmailTempRefresh();
                    window.close();
               }
            }
     });
     
     function closemywindow(){
          window.opener.GetEmailTempRefresh();
          window.close();
     }
        
	if(document.getElementById("flashMessage")==null)
		document.getElementById("mailtmp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
	function Backurlsupermailcontent(){
		window.location=baseUrl+'mailtasks/mailtemplatelist';
	}
</script>


