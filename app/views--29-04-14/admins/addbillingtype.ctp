<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script> 
<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'billingtype_list';
?>
<div class="container">

<div class="titlCont1"><div style="width:960px;margin:0 auto">
        <?php echo $form->create("Admins", array("action" => "addbillingtype",'name' => 'addbillingtype', 'id' => "addbillingtype",'onsubmit' => 'return validateBillingtype();'))?>
        <div align="center" id="toppanel" >
            <?php  //echo $this->renderElement('new_slider');  ?>
        </div>
		<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important;">			
<?php
e($html->link($html->image('help.png', array('width' => '42', 'height' => '41')) . ' ','coming_soon/help',array('escape' => false)));

?>			
</div>
        <span class="titlTxt">Billing Type Detail </span>
        <div class="topTabs">

            <ul>
				<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button></li>
            </ul>
            </ul>
        </div>
    </div></div>
<div class="boxBor1">
    <div class="boxPad">
        
             <div id="addprjtype">
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
                <table width="80%" align="left" cellpadding="1" cellspacing="5">
                    <tr>
                        <td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
                                echo $form->error('BillingType.billing_type', array('class' => 'errormsg'));
                                echo $form->error('BillingType.payment_type', array('class' => 'errormsg'));
                                echo $form->error('BillingType.billing_type', array('class' => 'errormsg'));
                        ?></td>
                    </tr>
					
                    <tr><td align="right"><label class="boldlabel">Billing Type <span class="red">*</span></label></td>
                        <td>
                            <span class="intpSpan"><label for="title"></label> 
                            <?php 
							echo $form->hidden("BillingType.id");
							echo $form->input("BillingType.billing_type", array('id' => 'billing_type', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?>
                             </span>

                        </td>
                    </tr>
					
					<tr><td align="right"><label class="boldlabel">Payment Type <span class="red">*</span></label></td>
                        <style>
						   .tdCheckClass label{padding:0px 10px;}
						</style>
						   
						<td class="tdCheckClass">
                           <?php 
							$options=array('cc'=>'Credit Card','check'=>'Check','other'=>'Other');
							$attributes=array('legend'=>false,'class'=>'mytest');
							echo $form->radio('BillingType.payment_type',$options,$attributes);
							?>

                        </td>
                    </tr>
					
					<tr><td align="right"><label class="boldlabel">Default- Credit Cards</label></td>
                        <td>
                            <?php echo $form->input('BillingType.default_cc', array('id' => 'default_cc','type'=>'checkbox','div' => false, 'label' => '','disabled'=>'disabled')); ?>  
						</td>
                    </tr>
					
					<tr><td align="right"><label class="boldlabel">Billing Period</label></td>
                        <td class="tdCheckClass">
                           <?php 
							$options=array('Monthly'=>'Monthly','Quarterly'=>'Quarterly','Annually'=>'Annually');
							$attributes=array('legend'=>false,'value'=>'Monthly');
							echo $form->radio('BillingType.billing_period',$options,$attributes);
							?>
                        </td>
                    </tr>
					
					<tr><td align="right" valign="top"><label class="boldlabel">Day of Month Billing</label></td>
                        <td>
                            <span class="intpSpan"><label for="title"></label> 
                            <?php echo $form->input("BillingType.month_billing_day", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:50px;","maxlength" => "2"));?>
                             </span>

                        </td>
                    </tr>
					
                    <tr><td valign='top' align="right"><label class="boldlabel">Note </label>&nbsp;</td>
                        <td>
                            <span class="txtArea_top">
                                <span class="newtxtArea_bot"><?php echo $form->textarea("BillingType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "noBg"));?>

                                </span></span>           
                        </td>
                    </tr>
					<tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
						<td colspan="2" aliign="left"><div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
                                <?php  echo $this->renderElement('bottom_message');  ?>
                            </div></td></tr>

                    <!-- ADD FIELD EOF -->  	
                    <!-- BUTTON SECTION BOF -->  
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                </table>
                <!-- ADD Sub Admin  FORM EOF -->

            </div>
		
		<div style="clear:both;"></div>
	</div>
</div>

<script type="text/javascript" language="JavaScript">
    
	
		
	

	
	function hidetextboxes(){
        var i;
        var j=parseInt(document.getElementById("maxnumbercomment").options[document.getElementById("maxnumbercomment").selectedIndex].value)+1;

        for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
        {
            document.getElementById("commenttype"+i).style.display="block";
            document.getElementById("commenttypevalue"+i).style.display="block";
        }


        if(j==2){
            for(i=1;i<=<?php echo $maxnumbercomment?>;i++)
            {
                document.getElementById("commenttype"+i).style.display="none";
                document.getElementById("commenttypevalue"+i).style.display="none";
            }
        }else{
            for(i=j;i<=<?php echo $maxnumbercomment?>;i++)
            {
                document.getElementById("commenttype"+i).style.display="none";
                document.getElementById("commenttypevalue"+i).style.display="none";
            }
        }
    }
    hidetextboxes();

    function checkboxfun(){
        if(document.getElementById("SiteTypeIstransferable").checked==false)
            {document.getElementById("SiteTypeSimpleCointransfer").checked=false;		}
    }
</script>			
<!--inner-container ends here-->

<div class="clear"></div>

<script type="text/javascript">
    if(document.getElementById("flashMessage")==null)
        document.getElementById("addprjtype").style.paddingTop = '24px';
    else
        {
        document.getElementById("blck").style.paddingTop = '10px';
    }	
	



$("input[name='data[BillingType][payment_type]']").change(function () {
	var selection=$(this).val();
	if(selection == 'cc'){ 
	$("#default_cc").attr('disabled',false);
	} else {
	$("#default_cc").attr('checked',false);
	$("#default_cc").attr('disabled',true);
	}
	//alert("Radio button selection changed. Selected: "+selection);
});

	
</script>
<!--container ends here-->

