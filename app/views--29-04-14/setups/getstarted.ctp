<?php  echo $javascript->link('ckeditor/ckeditor'); 

//echo "<pre>";print_r($value);
$dt=$value[0]['GetStart']['getdata'];
?>

<div class="titlCont"><div class="myclass">
<?php echo $form->create("setups", array("action" => "getstarted",'name' => 'getstarted', 'id' => "getstarted", 'class' => 'adduser'))?>
       <div align="center" id="toppanel" >
         <?php  echo $this->renderElement('new_slider');  ?>
</div>

  <span class="titlTxt">Get started </span>
        <div class="topTabs">
                <ul>
		<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
		<li><button type="button" id="saveForm" class="button"  ONCLICK="Backurl()"><span> Cancel</span></button></li>  
                <!--<li><button class="button" id="Submit" name="redirectpage" type="submit"><span> Save</span> </button>&nbsp;</li>
                <li><a href="#." class=""><span>Apply</span></a></li>
                <li><a href="/admins/"><span>Cancel</span></a></li>
                --></ul>
            
        </div>           <div class="clear"></div>
        <?php $this->getstarted="tabSelt"; echo $this->renderElement('super_admin_config_types');?>  
  
</div></div>

<?php	//if($session->check('Message.flash')){ ?><div style="width:400px;margin:0 auto;"><?php //$session->flash();?></div><?php //}?>
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
						echo $form->textarea('GetStart.getdata', array('id'=>'getdata','class'=>'ckeditor','value'=>$dt));						
						
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
<script>
function Backurl(){
   window.location=baseUrlAdmin;
}
</script>


