<?php $lgrt = $session->read('newsortingby');?>
<?php  echo $javascript->link('ckeditor/ckeditor');  ?>
<div class="titlCont"><div style="width:960px;margin:0 auto">
       <?php echo $form->create("Setups", array("action" => "edithelp/".$this->data['HelpContent']['id'],'name' => '', 'id' => "", 'class' => '', 'enctype' => "multipart/form-data",'onsubmit' => 'return validatepassword();'))?>
        <div align="center" id="toppanel" >
	        <?php  echo $this->renderElement('new_slider');  ?>
                
        </div>
        <span class="titlTxt">Edit Help </span>
         <div class="topTabs">
                <ul>
               <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Apply</span></button></li>
                <li><a href="<?php echo Configure::read('App.base_url');?>/setups/help_list"><span>Cancel</span></a></li>
                </ul>
            
        </div>  
                <div class="clear"></div>
                <?php $this->help_list="tabSelt"; ?><ul class="topTabs2" id="tab-container-1-nav">
        <li><a class="<?php echo (empty($this->changePassword)) ? '' : $this->changePassword; ?>" href="#"><span>Change Password</span></a></li>
        <li><a class="<?php echo (empty($this->help_list)) ? '' : $this->help_list; ?>" href="<?php echo Configure::read('App.base_url');?>/setups/help_list"><span>Help List</span></a></li>
	<li><a href="<?php echo Configure::read('App.base_url');?>/setups/getstarted"><span>Get Started</span></a></li>
</ul>
        </div>
</div></div>
    
<div class="rightpanel">

<div id="center-column"><br>
 	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


                
                        <table class="listing" cellpadding="0" cellspacing="0" style='float:left'>
                <!-- ADD USER FORM -->
        <?php echo $form->input("HelpContent.id", array( 'div' => false, 'label' => '',  "type" => "hidden")); ?>
                <table width="100%" align="center" cellpadding="5" cellspacing="5">
                
                
                <?php 
                /*    SERVER SIDE VALIDATION MESSAGES */
                
        
             echo $form->error('Admin.password', 'Old Password is required', array('class' => 'errormsg'));
            
             echo $form->error('Admin.password', 'New Password is required', array('class' => 'errormsg'));
             
             echo $form->error('Admin.Cpassword', 'Please confirm Password', array('class' => 'errormsg'));
           
        
                if($session->check('Message.flash')){ $session->flash();}

                /*   END  SERVER SIDE VALIDATION MESSAGES */

                ?>                
				 <tr> 
                        <td style='width:9%' align="right"  style="padding-bottom: 10px;"><label class="boldlabel">Name <span class="red">*</span></label></td>
                        <td><span class="intpSpan"><?php echo $form->input("HelpContent.name", array( 'div' => false, 'label' => '',  "class" => "inpt_txt_fld")); ?></span>
                     
                        </td>
                </tr>  <tr> 
                        <td align="right"><label class="boldlabel">Section <span class="red">*</span></label></td>
                        <td><?php echo $this->data["HelpContent"]["section"]; ?>
                        
                        </td>
                </tr>   
                <tr> 
              <!--          <td style='width:20%' valign="top"><label class="boldlabel">Name <span class="red">*</span></label></td>-->
                 <td colspan="2"><?php echo $form->textarea('HelpContent.content', array('id'=>'termscontent','class'=>'ckeditor')); ?>
                     
                        </td>
                </tr> 
        <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
        </tr>   
<tr>
<td colspan="2"><?php  echo $this->renderElement('bottom_message');  ?></td>
    </tr>
</table>
<?php echo $form->end();?>    
    <br >  
   
</div>
</div><!--inner-container ends here-->
<div class="clear"></div>
</div><!--container ends here-->
