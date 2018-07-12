<?php  echo $javascript->link('ckeditor/ckeditor');  ?>
<div class="titlCont"><div style="width:960px;margin:0 auto">
       <?php echo $form->create("Admins", array("action" => "edithelp/".$this->data['HelpContent']['id'],'name' => '', 'id' => "", 'class' => '', 'enctype' => "multipart/form-data",'onsubmit' => 'return validatepassword();'))?>
        <div align="center" id="toppanel" >
                <div id="panel">
                        <div class="content clearfix">
                                <H1> Help</h1>
                                <p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
                        </div>
                </div> 
        <!-- The tab on top --> 
                <div class="tab">
                        <ul class="login">
                                <li id="toggle"><a id="open" class="open" href="#."><span>Click Here to Open Help Box</span></a><a id="close" style="display: none;" class="close" href="#"><span>Click Here to Close Help Box</span></a>               
                                </li>
                        </ul> 
                </div>
        </div><span class="titlTxt">Edit Help </span>
         <div class="topTabs">
                <ul>
                <li><button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>&nbsp;</li>
                <li><button class="button" id="Submit" name="noredirection" type="submit"><span> Apply</span> </button>&nbsp;</li>
                <li><a href="/admins/help_list"><span>Cancel</span></a></li>
                </ul>
            
        </div>  
                <div class="clear"></div>
                <?php $this->help_list="tabSelt"; ?><ul class="topTabs2" id="tab-container-1-nav" style="padding-left: 40px;">
        <li><a class="<?php echo (empty($this->changePassword)) ? '' : $this->changePassword; ?>" href="/admins/changePassword"><span>Change Password</span></a></li>
        <li><a class="<?php echo (empty($this->help_list)) ? '' : $this->help_list; ?>" href="/admins/help_list"><span>Help List</span></a></li>
	<li><a href="/admins/getstarted"><span>Get Started</span></a></li>
</ul>
        </div>
</div></div>
    
<div class="rightpanel">

<div id="center-column">

                
                        <table class="listing" cellpadding="0" cellspacing="0" style='float:left'>
                <!-- ADD USER FORM -->
        <?php echo $form->input("HelpContent.id", array( 'div' => false, 'label' => '',  "type" => "hidden")); ?>
                <table width="100%" align="center" cellpadding="5" cellspacing="5">
                
                <tr>
                <td colspan="2">
                <?php 
                /*    SERVER SIDE VALIDATION MESSAGES */
                
        
             echo $form->error('Admin.password', 'Old Password is required', array('class' => 'errormsg'));
            
             echo $form->error('Admin.password', 'New Password is required', array('class' => 'errormsg'));
             
             echo $form->error('Admin.Cpassword', 'Please confirm Password', array('class' => 'errormsg'));
           
        
                if($session->check('Message.flash')){ $session->flash();}

                /*   END  SERVER SIDE VALIDATION MESSAGES */

                ?>
                
                        </td>
                </tr>
                
           
                <tr> 
                        <td style='width:20%'><label class="boldlabel">Name <span class="red">*</span></label></td>
                        <td><span class="intpSpan"><?php echo $form->input("HelpContent.name", array( 'div' => false, 'label' => '',  "class" => "inpt_txt_fld")); ?></span>
                     
                        </td>
                </tr>  <tr> 
                        <td><label class="boldlabel">Section <span class="red">*</span></label></td>
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
<td colspan="2"><b>Any item with a</b>  "<span class="red">*</span>"  <b>requires an entry.</b></td>


    </tr>
</table>


<?php echo $form->end();?>    
    <br >  
   
</div>
</div><!--inner-container ends here-->
<div class="clear"></div>
</div><!--container ends here-->