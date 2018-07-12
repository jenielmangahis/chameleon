<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'border_footer_list';
?>
<?php
echo $javascript->link('ckeditor/ckeditor'); 
?>

<script type="text/javascript">
        /* <![CDATA[ */
                $(function() {
                                  $('#startdateBP').datetime({
                                                                          userLang : 'en',
                                                                          americanMode: false, 
                                                                });
                                        $('#enddateBP').datetime({
                                                                          userLang : 'en',
                                                                          americanMode: false, 
                                                                });
                        });
                        
                      
     var dateobj = new Date();
   
        $(function() {
                    
                    $('#member_agefrom').datepicker({
                    showOn: "button",
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true
                   // yearRange: currDate+':'+rangeDate 
                });
                
                $('#member_ageto').datepicker({
                    showOn: "button",
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true
                   //  yearRange: currDate+':'+rangeDate 
                });
               
               
                 $('#task_startdate').datepicker({
                    showOn: "button",
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true
                   // yearRange: currDate+':'+rangeDate 
                });
                
                $('#task_end_by_date').datepicker({
                    showOn: "button",
                    buttonImage: "/img/calendar_new.png",
                    dateFormat: 'mm-dd-yy',
                    changeMonth: true,
                    changeYear:true
                   //  yearRange: currDate+':'+rangeDate 
                });
               
          });
      /* ]]> */
      
        </script>
<div class="container"> 	
<div class="titlCont">
<div class="myclass">
<?php echo $form->create("Admins", array("action" => "mail_footer",'name' => 'mail_footer', 'id' => "mail_footer", 'class' => 'adduser'))?>
       <div align="center" id="toppanel" >
         <?php  echo $this->renderElement('new_slider');  ?>
</div>

		<span class="titlTxt">Border Footer </span>
        <div class="topTabs">
                <ul class="dropdown">
                             <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                              <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                              <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
                    
                </ul>
        </div> 
		<div class="clear"></div>
        
         <?php $this->mail_tasks="tabSelt"; echo $this->renderElement('super_admin_config_types'); ?>   
</div></div>

<div class="midPadd" id="sndmail">
    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>          
    
       

  <!--<table id="loading"  width="100%" style="height: 100%;"><tr style="height: 540px;" ><td align="center"><img src="/img/ajax-pageloader.gif" alt="Imagecoins:pageloader" /></td></tr></table> -->
    <div id="addcomm" class="">  
        <!-- START:  Task Setup Design as per Requirement --> 
		
        <table cellspacing="10" cellpadding="0" align="center" width="100%">   
            <tbody>
                <tr>
				<td align="right">
					<div class="updat">
					<label><b>Agreement Name</b><span class="red">*</span></label></div>
				</td>
				<td width="auto">
					<span class="intpSpan">
						<label for="title"></label> 
						<?php echo $form->input("UserAgreement.agreement_name", array('id' => 'agreement_name', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
					</span>
				</td>
				<td align="right">
                        <div class="updat">
                        <label class="boldlabel">Last Edit Date <span class="red">*</span></label></div>
				</td>
				<td width="auto">
					<span class="intpSpan">
						<label for="title"></label> 
						<?php
						echo $form->input("UserAgreement.mod", array('id' => 'modified', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200",'value'=>'','readonly'=>'readonly'));?>
					</span>
				</td>
				
				</tr>
				<tr>
					<td  width="100" align="right" style="padding-top: 5px;">
					<div class="updat" style="width: 165px;">
						<label><b>Default-New Projects</b></label>&nbsp;</div></td>
					<td valign="middle">
				<?php echo $form->input("UserAgreement.default_new_projects", array('id' => 'default_new_projects', 'div' => false, 'label' => '','type'=>'checkbox'));?>                             
				  </td>
				  <td colspan="2">&nbsp;</td>
				</tr>

                <tr>
                    <td colspan="4">   <?php    echo $form->textarea('EmailTemplate.content', array('id'=>'content','class'=>'ckeditor'));  ?>    </td>
                </tr>       

                <tr><td colspan="4">&nbsp;</td></tr>

            </tbody>
        </table>
        
        <!-- END : Task Setup Design -->  
     
    </div>
	<div class="clear"></div>


</div>

<div class="clear"></div>

</div>

<!--inner-container ends here-->


<!--container ends here-->