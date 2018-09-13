 <?php $lgrt = $session->read('newsortingby');
 echo $javascript->link('colorpicker/js/eye.js');
	echo $javascript->link('colorpicker/js/colorpicker.js');
	echo $javascript->link('colorpicker/js/utils.js');
	echo $html->css('colorpicker/colorpicker.css');
 $base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'membertypes';
 ?>
<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2><?php echo $pageactionname;?> Member Type</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
            	<?php echo $form->create("Admins", array("action" => "addmembertype",'name' => 'addmembertype', 'id' => "addmembertype",'onsubmit' => 'return validateMemberType("add");'));
				echo $form->hidden("MemberType.id", array('id' => 'membertypeid','value'=>"$membertypeid")); 
				
				?>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]">
				<?php e($html->image('save.png')); ?></button>	
				<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]">
				<?php e($html->image('apply.png')); ?></button>	
				<button type="button" id="saveForm" class="sendBut"  onclick="javascript:(window.location='<?php echo $backUrl;?>'); "  ><?php e($html->image('cancle.png')); ?></button>
				<?php echo $this->renderElement('new_slider'); ?>			
            </div>
        </div>
        <div class="topTabs" style="height:25px;">
                <?php /*?><ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
        <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
          <li><button type="button" id="saveForm" class="button"  onclick="javascript:(window.location='<?php echo $backUrl;?>'); "  ><span> Cancel</span></button></li>
            </ul><?php */?>
        </div>
    </div>
</div>


<div class="clearfix nav-submenu-container">
	<div class="midCont">
		<?php    $this->loginarea="admins";    $this->subtabsel="membertypes";
                    echo $this->renderElement('memberlist_submenus');  ?> 
    </div>
</div>
    
	
<div class="midCont table-responsive">
		<div id="addcmp" style="height:300px;">

	<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


		<!-- ADD Sub Admin FORM BOF -->
                  
		<table class="table table-borderless" width="100%" align="left" cellpadding="3" cellspacing="3">
		
		<tr><td align="right" style="width: 15%;" valign="top"><label class="boldlabel">Member Type <span class="red">*</span></label></td>
				<td style="width: 85%;"> <span class="intp-Span">
				<?php  if(!empty($membertypeid)){
					$readonly = 'disabled';
				}else{
					$readonly = '';
				}
				echo $form->input("MemberType.member_type", array('id' => 'member_type', 'div' => false, 'label' => '','disabled' => $readonly, "class" => "inpt-txt-fld form-control","maxlength" => "200"));?></span></td><td>&nbsp;</td><td>&nbsp;</td>
	        </tr>
			<tr>
			<td align="right" style="width: 15%;" valign="top">
				&nbsp;&nbsp;<label class="boldlabel">Google PIN Color</label>
				</td><td>
			 <span class="intp-Span"><?php echo $form->input('MemberType.pincolor',array('class'=>'inpt-txt-fld form-control','div'=>false,'label'=>false,'style' =>'width:115px;')); ?></span> &nbsp;&nbsp;
				
			</td>
			
		</tr>  
                       
         
            <tr><td align="right" valign="top"><label class="boldlabel">Notes </label></td>
                <td><span class="txtArea-top">
                          <span class="newtxtArea-bot">
                          <?php echo $form->textarea("MemberType.note", array('id' => 'note', 'div' => false, 'label' => '','cols' => '27', 'rows' => '5',"class" => "form-control noBg"));?>
                          </span></span>
                </td>

            </tr>
	      
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2"><?php  echo $this->renderElement('bottom_message');  ?>     </td></tr>        
	
	    </table> 
<?php echo $form->end();?>

					
					<!-- ADD Sub Admin  FORM EOF -->

				
			</div>  </div>
            </div><div>
<!--inner-container ends here-->

  




<div class="clear"></div>


</div><!--container ends here-->

<script type="text/javascript">

          
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addcmp").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
    
    function validateMemberType()
    {
            if($('#member_type').val() == '')
             {
                 inlineMsg('member_type','<strong>Please provide member type name.</strong>',2);
                 return false;
             }
             if(tagValidate($('#member_type').val()) == true){
                 inlineMsg('member_type','<strong>Please dont use script tags.</strong>',2);
                 return false; 
             } 
        return true;
    }
</script>
</script>
<script type="text/javascript" language="javascript">    
    $('#MemberTypePincolor').ColorPicker({
                onSubmit: function(hsb, hex, rgb, el) {
                    $(el).val(hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                }
            })
            $('backcolor,#textcolor').bind('keyup', function(){
                $(this).ColorPickerSetColor(this.value);
            });
			
			
</script>