<?php  
echo $javascript->link('ckeditor/ckeditor');
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'contentlist';
?>

<!--container starts here-->
<div class="container">
<div class="titlCont">
<div class="myclass">
        
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">			

        <?php echo $form->create("Admins", array("action" => "page_footer",'name' => 'page_footer', 'id' => "page_footer"))?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                document.getElementById('projectid').value= projectid;
                document.adminhome.submit();
            }
        </script>
		<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
 <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png')); ?></button>
<?php  echo $this->renderElement('new_slider');  ?>
</div>
         <?php  echo $this->renderElement('project_name');  ?> 
        <span class="titlTxt">
            Page Footer
        </span>
     <div class="topTabs" style="height:25px;">
                <?php /*?><ul>
        <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
        <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>  
                <!--<li><button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>&nbsp;</li>
                <li><a href="#." class=""><span>Apply</span></a></li>
                <li><a href="/admins/"><span>Cancel</span></a></li>
                --></ul><?php */?>
            
        </div> 


        <?php    $this->loginarea="admins";    $this->subtabsel="page_footer";
if($_GET['url'] === 'admins/page_footer/0'){
		echo $this->renderElement('emails_submenus'); 

}else{
		echo $this->renderElement('setting_submenus'); 
}

					?>   
    </div></div>
    
    
    <?php    //if($session->check('Message.flash')){ ?><div style="width:400px;margin:0 auto;"><?php //$session->flash();?></div><?php //}?>
<div class="clear"></div>


        
<div class="rightpanel">


<?php if($session->check('Message.flash')){ ?> 
<div id="blck"> 
        <div class="msgBoxTopLft"><div class="msgBoxTopRht"><div class="msgBoxTopBg"></div></div></div>
            <div class="msgBoxBg">
                <div class="">
				<?php
				e($html->link(
					$html->image('close.png',array('style'=>'margin-left: 945px; position: absolute; z-index: 11;','alt'=>'Close')),
					'javascript:void(0)',
					array('escape' => false,'onclick' => "hideDiv()")
					)
				);
				$session->flash();
				?> 
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
                    echo $form->hidden('PageFooter.id',array('id'=>'id','value'=>$page_footer_id));
            
                        echo $form->textarea('PageFooter.page_footer_content', array('id'=>'mailfooter','class'=>'ckeditor','value'=>$page_footer_content));                        
                        
                ?>
            </td>
            </tr>
          
        
        
    <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>    


                    
                    
                </table>
                
            </div>

 
</div><!--inner-container ends here-->

  

<?php echo $form->end();?>


<div class="clear"></div>


</div><!--container ends here-->


