<?php $lgrt = $session->read('newsortingby');
    $coinHolder = $this->params['pass'][0];
    //echo $javascript->codeBlock("var coinHolder = $coinHolder");
?>   
  
<style type="text/css">
    .ui-datepicker-trigger{position:absolute;background:none;margin-left:5px;}
</style>


<!--container starts here-->
<?php 
if(isset($paging)){
	$pagination->setPaging($paging); 
}
?>  
    <div class="titlCont">
        <div style="width:960px; margin:0 auto;">
           
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">
                <?php  if($_GET['url']==='admins/coming_soon/help')
						{ ?>
<?php  echo $this->renderElement('new_slider');  ?>			

                  <?php       }else{ ?>
					
<?php  echo $this->renderElement('new_slider');  ?>	
				  
			<?php	  //echo $this->renderElement('new_slider'); 
			 }?>
            </div>
           <?php //echo $form->create("Admins", array("action" => "memberhistory",'name' => 'memberhistory', 'id' => "memberhistory")) ?>      
            <span class="titlTxt1"><?php echo $project['Project']['project_name'];  ?>&nbsp;</span>
            <span class="titlTxt"> <?php echo ucfirst($tabpagename); ?> </span>
  
            <div class="topTabs">
                            <!--  <ul>
      <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                    <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>    
                    <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='/< ?php echo $lgrt;?>')"><span> Cancel</span></button></li>    
                </ul>                     -->
            </div>

           
                        <?php    $this->loginarea="admins";    $this->subtabsel=$tabpagename;
                        $menu_element=$topmenuname."_submenus";
						if($_GET['url']==='admins/coming_soon/call'||$_GET['url']==='admins/coming_soon/help')
						{
						
                        }
						elseif($_GET['url']==='admins/coming_soon/coinpricing/project' || $_GET['url']==='admins/coming_soon/systempricing/project')
						{
							echo $this->renderElement('setup_submenus');
						}
						elseif($_GET['url']==='admins/coming_soon/call/1' ||  $_GET['url']==='admins/coming_soon/task')
						{
						 echo $this->renderElement('memberlistsecondlevel_submenus');
						}
						
						else{    echo $this->renderElement($menu_element);}


                              ?>                     
   <?php  //echo $this->renderElement('donation_submenus');  ?>
        </div>
    </div>




  <div class="midCont" id="newhldtab">



    <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

    <!-- top curv image starts -->
                     <?php  echo $this->renderElement('coming_soon');  ?>              
<!--inner-container ends here-->
  </div>   


    <div class="clear"></div>
 </div>      