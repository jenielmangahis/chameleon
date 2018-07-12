<?php  echo $javascript->link('ckeditor/ckeditor'); 

?>

<!--container starts here-->
<?php $pagination->setPaging($paging); ?>
<div class="container">
<div class="titlCont">
<div class="myclass">
        <div align="center" class="slider" id="toppanel">
            <div id="panel">
                <div class="content clearfix">
                    <H1> Help</h1>
                    <p class="grey"><?php echo $hlpdata[0]['HelpContent']['content']; ?></p>
                </div>

            </div> <!-- /login -->  

            <!-- The tab on top --> 
            <div class="tab">
                <ul class="login">
                    <li id="toggle">
                        <a id="open" class="open" href="#."><span>Open Help Box</span></a>

                        <a id="close" style="display: none;" class="close" href="#"><span>Close Help Box</span></a>               
                    </li>
                </ul> 
            </div>



        </div>


        <?php echo $form->create("Companies", array("action" => "page_footer",'name' => 'page_footer', 'id' => "page_footer"))?>
        <script type='text/javascript'>
            function setprojectid(projectid){
                document.getElementById('projectid').value= projectid;
                document.adminhome.submit();
            }
        </script>
         <?php  echo $this->renderElement('project_name');  ?> 
        <span class="titlTxt">
            Page Footer
        </span>
     <div class="topTabs">
                <ul>
        <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
        <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/admins/contentlist')"><span> Cancel</span></button></li>  
                <!--<li><button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>&nbsp;</li>
                <li><a href="#." class=""><span>Apply</span></a></li>
                <li><a href="/admins/"><span>Cancel</span></a></li>
                --></ul>
            
        </div> 


         <?php    $this->loginarea="companies";    $this->subtabsel="page_footer";
             echo $this->renderElement('websites_submenus');  ?>  
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


