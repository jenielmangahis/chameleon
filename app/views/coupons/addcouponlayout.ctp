<?php  	
$base_url= Configure::read('App.base_url');
$backUrl = $base_url.'coupons/layout';
?> 



<!-- Body Panel starts -->
<div class="container">

   <div class="titlCont">
   <div class="myclass">
   <div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right:-50px;width:545px !important; text-align:right;">
			<?php
	echo $javascript->link('ckeditor/ckeditor'); 
    echo $form->create("coupons", array("action" => "addcouponlayout",'name' => 'addcouponlayout', 'id' => "addcouponlayout","onsubmit"=>"return validateCouponLayout('add');"));
    echo $form->hidden("CouponLayout.id", array('id' => 'id'));
    echo $form->hidden("CouponLayout.project_id", array('value' => '1'));
 ?>
 <button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
 <button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
 <button type="button" id="saveForm" class="sendBut" ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><?php e($html->image('cancle.png')); ?></button>
                <?php  echo $this->renderElement('new_slider');  ?>
            </div>
            <span class="titlTxt"> Coupon layout Add/Edit  </span>
          <div class="topTabs" style="height:25px;">
            <?php /*?><ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                <li><button type="button" id="saveForm" class="button" ONCLICK="javascript:(window.location='<?php echo $backUrl;?>')"><span> Cancel</span></button></li>
            </ul><?php */?>
        </div>
          <?php    $this->loginarea="coupons";    $this->subtabsel="layouts";
             echo $this->renderElement('coupons_submenus');  ?>    
        </div>
        </div>


<div class="midCont">

<div class="boxBor1">

        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>
        <div class="clear"></div>
    </div>
    <br/>
    <div class="boxBor1">
        <table cellspacing="10" cellpadding="0" align="center" width="100%">   
            <tbody>
                <tr>
                    <td width="65%">
                        <table cellspacing="5" cellpadding="0" align="center" width="95%">
                            <tbody>
                          
                          
                            <?php
                           // }
                            ?>

                                <tr>
                                    <td width="25%"><label class="boldlabel">Coupon Layout Name <span class="red">*</span></label></td>
                                    <td width="75%"><span class="intpSpan"><?php echo $form->input("CouponLayout.layout_name", array('id' => 'layout_name', 'div' => false, 'label' => '','style' =>'width:230px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
                                </tr>

                                <tr>
                                    <td width="25%"><label class="boldlabel">Description<span class="red">*</span></label></td>
                                    <td width="75%">
									<span class="txtArea_top">
                                            <span class="newtxtArea_bot">
                                                <?php echo $form->input("CouponLayout.description", array('id' => 'description', 'div' => false, 'label' => '','rows'=>'3','cols'=>'65','style' =>'width:230px;',"class" => "noBg"));?>
                                            </span>
                                        </span>
									</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
               </tr>
               <tr>
                    <td colspan="2">   <?php    echo $form->textarea('CouponLayout.layout', array('id'=>'content','class'=>'ckeditor'));  ?>    </td>
                </tr>       

                <tr><td colspan="2">&nbsp;</td></tr>

            </tbody>
        </table>
        <div style="margin-bottom: 10px ; text-align: left; color:black" class="top-bar">
        <?php  echo $this->renderElement('bottom_message');  ?>   </div>

    </div>
  
</div>

<div class="clear"></div>

<script type="text/javascript">
    function validateCouponLayout(actionfor){

	if($('#layout_name').val() == '')
	 {
		 inlineMsg('layout_name','<strong>Please provide Coupon Layout Name.</strong>',2);
		 return false; 
	 }
	 
	if(hasWhiteSpace($('#layout_name').val()) == true){
		 inlineMsg('layout_name','<strong>Please dont use blank space.</strong>',2);
		 return false; 
	}
	if(tagValidate($('#layout_name').val()) == true){
		 inlineMsg('layout_name','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	
	if($('#description').val() == '')
	 {
		 inlineMsg('description','<strong>Please provide Description.</strong>',2);
		 return false; 
	 }
	if(hasWhiteSpace($('#description').val()) == true){
		 inlineMsg('description','<strong>Please dont use blank space.</strong>',2);
		 return false; 
	}
	if(tagValidate($('#description').val()) == true){
		 inlineMsg('description','<strong>Please dont use script tags.</strong>',2);
		 return false; 
	}
	return true;
}
$('#CouponMenu').removeClass("butBg");
	$('#CouponMenu').addClass("butBgSelt");
</script>

