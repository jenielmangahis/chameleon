<script type="text/javascript">
$(document).ready(function() {
$('#EmailMnu').removeClass("butBg");
$('#EmailMnu').addClass("butBgSelt");
}); 
</script>
<?php 
	$lgrt = $session->read('newsortingby');
	$base_url = Configure::read('App.base_url');
	$backUrl = $base_url.'mailtasks/maildefaults';
?>

<!-- Body Panel starts -->
<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2>Email "Forms" Defaults</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php 
						echo $form->create("mailtasks", array("action" => "maildefaults", 'name' => 'maildefaults', 'id' => "maildefaults", 'onsubmit'=>'return validateform()'));
				 ?>
				 <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
				<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><?php e($html->image('cancle.png')); ?></button>	
				<?php  echo $this->renderElement('new_slider');  ?>	
            </div>
        </div>
        <div class="topTabs" style="height:25px;">
            <?php /*?><ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button></li>
            </ul><?php */?>
        </div>
    </div>
    
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont submenu-Cont">
		 <?php   
           	 $this->maildefaults="tabSelt";
           	 $this->subtabsel="maildefaults";
             echo $this->renderElement('emails_submenus');  ?>
    </div>
</div>
     
<div class="midPadd midCont">
    <div class="boxBor1">

        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <div class="clear"></div>
    </div>
    <br/>
    <div class="boxBor1 table-responsive">
        <table class="table table-borderless" cellspacing="10" cellpadding="0" align="center" width="100%">   
            <tbody>
                <tr>
                    <td width="60%">
                        <table cellspacing="10" cellpadding="0" align="center" width="100%">
                            <tbody>
                                    <tr>
                                        <td width="25%" align="right" style="vertical-align: middle;"><label class="boldlabel">From Email</label>&nbsp;</td>
                                        <td width="75%">
                                         <span class="intpSpan">
                                        		<?php echo $form->input("Project.fromemail.", array('id' => 'fromemail', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                                        </span>
                                        </td>
                                    </tr>
                                                                    
                                    <tr>
                                        <td width="25%" align="right" style="vertical-align: middle;"><label class="boldlabel">From Name</label>&nbsp;</td>
                                        <td width="75%">
                                         <span class="intpSpan">
                                        		<?php echo $form->input("Project.fromname.", array('id' => 'fromname', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                                        </span>		
                                        </td>
                                    </tr>
          
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php echo $form->end();?>
        <div style="margin-bottom: 10px ; text-align: left; color:black" class="top-bar">
        <?php  echo $this->renderElement('bottom_message');  ?>   </div>

    </div></div> </div>
 
<!--inner-container ends here-->

  
<div class="clear"></div>
  <!-- Body Panel ends -->
        <?php echo $form->end();?>

<div class="clear"></div> 

<script type="text/javascript">

	function validateform(){
			var email = $('#fromemail').val();
		    var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		     if(email=="")
		     {
		         return true;
		     }
		     if(!email.match(emailRegex))
		      {
		    	 inlineMsg('fromemail','<strong>Invalid Email.</strong>',2);
		        return false;
		      }
		    return true;
	}
</script>

