<script type="text/javascript">
	$(document).ready(function() {
		$('#playMnu').removeClass("butBg");
		$('#playMnu').addClass("butBgSelt");
	}); 
</script>
<?php $lgrt = $session->read('newsortingby');
$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'players/adddetail/'.$option.'/'.$current_company; ?>

<script  type="text/javascript">
//function addwebpages(){
	// resWindowweb=  window.open (baseUrl+'admins/addcontentpage/popup_company', 'Add Web Pages','location=1,status=1,scrollbars=1, width=500,height=500');
//}
</script>
<?php echo $javascript->link('ckeditor/ckeditor'); ?>
<div class="container">
         <div class="titlCont">
		  <div class="centerPage" >
            
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">			

       <?php 
            echo $form->create("players", array("action" => "addwebpage/".$option, 'name' => 'addwebpage', 'type' => 'file','enctype'=>'multipart/form-data', 'id' => "addwebpage"));  
            echo $form->hidden("option", array('id' => 'option','value'=>"$option"));
            echo $form->hidden("Company.id", array('id' => 'companyid'));  
			echo $form->hidden("projectname", array('id' => 'projectname','value'=>"$projectname"));
			echo $form->hidden("projectid", array('id' => 'projectid','value'=>"$project_id"));
 	   ?>
          <script type='text/javascript'>
              function setprojectid(projectid){
                  document.getElementById('projectid').value= projectid;
                  document.adminhome.submit();
               }
          </script>
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
<?php e($html->image('save.png', array('alt' => 'Save'))); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
<?php e($html->image('apply.png', array('alt' => 'Apply'))); ?></button>
<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><?php e($html->image('cancle.png', array('alt' => 'Cancle'))); ?></button>
		  <?php
//e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ','coming_soon/help',array('escape' => false)));
echo $this->renderElement('new_slider'); 
?>			
</div>

            
          <span class="titlTxt1"><?php  //echo $current_company_name; echo ($current_company_name !='')? ' : ' :'';  ?></span>&nbsp;
          <span class="titlTxt"><?php echo ucfirst($option); ?> Web Pages</span>
          <div class="topTabs" style="height:25px;">
             <?php /*?><ul>
				 <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
				 <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
				 <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
			  </ul><?php */?>
          </div>
          <div class="clear "></div> 
        
	         <?php $this->loginarea="players";    $this->subtabsel='webpages';   
			 
			// echo $this->renderElement('players/player_inner_submenu');  
			    echo $this->renderElement('players/playermerchant_submenus'); 
			 ?>
	        
             </div>                 
        </div>
<div id="addcmp"  class="midCont">	
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
<table cellspacing="10" cellpadding="0">
		
  <?php if($session->check('Message.flash')){ ?>
    <tr>
      <td colspan="5"> <?php $session->flash();	?> </td>
    </tr>
  <?php }?>  
 
	<tr>
		<td valign='top' align="right"><label class="boldlabel"><?php echo ucfirst($option); ?> Webpages</label></td>
		<td width="85%">
			 <span class="txtArea_top">
				<span class="newtxtArea_bot">
					 
					<?php echo $form->select("Content.id",$webpagedropdown,$selectedwebpage,array('id' => 'id','class'=>'multilist'),"---Select---"); ?>
				</span>
			 </span>
			<!--  <span style="margin-top:7px;" class="btnLft">
			 	<input type="button" value="Add" name="Add" tabindex=15 class="btnRht" ONCLICK="addwebpages()"/>
			 </span>
			 -->	
		</td> 
	</tr>

	<tr> 			  
		<td colspan="2">
			<?php echo $form->textarea('Content.content', array('id'=>'content','class'=>'ckeditor',"rows"=>"100")); ?> 
		</td>
	</tr>
			 
	<tr>
		<td colspan="2" style="text-align: left; padding: 20px 5px 20px 5px ;" class="top-bar">
                             <?php  echo $this->renderElement('bottom_message');  ?>
        </td>
   </tr>
   
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

    function addwebpage(){
		
    }
</script>