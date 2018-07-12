<?php  echo $javascript->link('ckeditor/ckeditor'); ?>
<div class="container">
<div class="titlCont"><div style="width:960px; margin:0 auto;">
            <div align="center" class="slider" id="toppanel">
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
              <?php echo $form->create("Company", array("action" => "projectbackup",'name' => 'projectbackup', 'id' => "projectbackup"));?>                                                                                                                   
            <span class="titlTxt1"><?php // echo $project['Project']['project_name'];  ?>&nbsp;</span>
            <span class="titlTxt">   Spam Policy     </span>
            
            <div class="topTabs">
                <ul class="dropdown">
                            <!--<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/dashboard')"><span> Cancel</span></button></li>-->
                </ul>
            </div>

            <?php    $this->loginarea="companies";    $this->subtabsel="spam_policy_project";
                    echo $this->renderElement('emails_submenus');  ?> 
        </div></div> 
        
        

<div class="midCont" id="newcoinsettab">


    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
    
        <table width="100%" cellpadding="1" cellspacing="1">
                    <tr>
                        <td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('SpamPolicy.policy_content', array('class' => 'errormsg'));
                        ?></td>
                    </tr>

                                       
                    <tr>
                    <td width="100%" colspan="5">
                    <?php    
                        echo $form->textarea('SpamPolicy.policy_content', array('id'=>'policy_content','class'=>'ckeditor','value'=>$data['SpamPolicy']['policy_content']));                        
                        
                        ?>
                    </td>
                    </tr>


                    <tr><td>&nbsp;</td></tr>

                    <!-- ADD FIELD EOF -->      
                    <!-- BUTTON SECTION BOF -->  
                   
                    <tr><td>&nbsp;</td></tr>

                </table>    </div>
       
     <?php                   echo $form->end();    ?>

    <div class="clear"></div>
</div>     
<script type="text/javascript">
    if(document.getElementById("flashMessage")!=null)
        {        
  //      document.getElementById("newcntlist").className = "newmidCont";
    }    
</script>




