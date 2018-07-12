<?php  echo $javascript->link('ckeditor/ckeditor');  
?>

<div class="titlCont"><div class="myclass">
<?php echo $form->create("Setups", array("action" => "mail_footer",'name' => 'mail_footer', 'id' => "mail_footer", 'class' => 'adduser'))?>
       <div align="center" id="toppanel" >
         <?php  echo $this->renderElement('new_slider');  ?>
</div>

  <span class="titlTxt">Mail Footer </span>
        <div class="topTabs">
                <ul>
        <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
        <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location=baseUrlAdmin+'/index')"><span> Cancel</span></button></li>  
                <!--<li><button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>&nbsp;</li>
                <li><a href="#." class=""><span>Apply</span></a></li>
                <li><a href="/admins/"><span>Cancel</span></a></li>
                --></ul>
            
        </div>           <div class="clear"></div>
        
         <?php $this->mail_footer="tabSelt"; echo $this->renderElement('super_admin_config_types'); ?>   
         
              <!--  <ul class="topTabs2" id="tab-container-1-nav" style=" padding-left: -40px;">
        <li><a class="< ?php echo (empty($this->changePassword)) ? '' : $this->changePassword; ?>" href="/admins/super_admin_changepassword"><span>Change Password</span></a></li>
        <li><a class="tabSelt" href="/admins/mail_footer"><span>Mail Footer</span></a></li>
        <li><a class="< ?php echo (empty($this->help_list)) ? '' : $this->help_list; ?>" href="/admins/help_list"><span>Help List</span></a></li>
         <li><a class=" < ?php echo (empty($this->producttype)) ? '' : $this->producttype; ?>" href="/admins/producttype"><span>Products</span></a></li> 
         <li><a class="< ?php echo (empty($this->mailtempaltes)) ? '' : $this->mailtempaltes; ?>" href="/admins/supermailtemplatelist"><span>Mail Templates</span></a></li>   
    <li><a class="" href="/admins/getstarted"><span>Get Started</span></a></li>
       
</ul>            -->
  
</div></div>

<?php    //if($session->check('Message.flash')){ ?><div style="width:400px;margin:0 auto;"><?php //$session->flash();?></div><?php //}?>
<div class="clear"></div>


        
<div class="rightpanel">


<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class=""><a href="#." onclick="hideDiv();"><img src="/img/close.png" alt="" style="margin-left: 945px;
    position: absolute;
    z-index: 11;" /></a>
                    <?php  $session->flash();    ?> 
                </div>
                    <div class="msgBoxBotLft"><div class="msgBoxBotRht"><div class="msgBoxBotBg"></div></div></div>
        </div>
</div>
                                            <?php } ?>

<div id="center-column">
            
        <!-- ADD USER FORM -->
    
        <table width="100%" align="center" cellpadding="1" cellspacing="1">
        <tr>
              <td width="100%" colspan=2 style="vertical-align:top" >
            <?php    
                        echo $form->textarea('MailFooter.footer_content', array('id'=>'mailfooter','class'=>'ckeditor','value'=>$footer_content));                        
                        
                ?>
            </td>
            </tr>
          
        
        
    <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>    

<?php echo $form->end();?>
                    
                    
                </table>
                
            </div>

 
</div><!--inner-container ends here-->

  




<div class="clear"></div>


</div><!--container ends here-->


