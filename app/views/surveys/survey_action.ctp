<?php
$base_url = Configure::read('App.base_url').'surveys';
$backUrl = $base_url.'surveys';
?>
<style type="">
    .line {
        background: none repeat scroll 0 0 #BDBCBD;
        clear: both;
    }
    .grayText {
        color: #777777;
    }

    .forName {
        border-right: 1px solid white;
        font-size: 12px;
        padding: 5px 12px;
        vertical-align: top;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() { 
    		$('#SurveyMnu').removeClass("butBg");
    		$('#SurveyMnu').addClass("butBgSelt");
    });

    function validateactionform(){
        
		if ( document.messagenew.recevier_id.value == "" ) {
			inlineMsg('recevier_id','<strong>Please select at least one holder.</strong>',2);     
			return false;  
		}
        return true;
    }

</script>

<div class="titlCont">
	<div class="slider-centerpage clearfix">
    	<div class="center-Page col-sm-6">
            <h2>Survey Action List</h2>
        </div>
        <div class="slider-dashboard col-sm-6">
        	<div class="icon-container">
				<?php echo $form->create("Surveys", array("action" => "survey_action", "onsubmit"=>"return validateactionform();")); 
				echo $form->hidden("SurveyAction.id");        ?>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
				<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>
				<button type="button" id="saveForm" class="sendBut"  ONCLICK="javascript:(window.location='<?php echo $base_url.'/surveyactionlist' ?>')"><?php e($html->image('cancle.png')); ?></button>
				<?php echo $this->renderElement('new_slider');   ?>
            </div>
        </div>
    </div>
</div>

<div class="midCont clearfix">
    	<div class="top-bar" style="border-left:0px;"></div>
            <div class="">	
                <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>       
                <div class="clear"></div>
            </div>
                <div style="border-left: 0px none; text-align: right; color: rgb(255, 255, 255);" class="top-bar" id="addcnttab"></div>
              

     
        
            <table  cellpadding="5" cellspacing="8" align="center" width="90%" >
                <tr>
                    <td valign="top">
                        <div class="updat" style="vertical-align: top;">
                            <label class="boldlabel">Survey Action  <span style="color: red;">*</span></label>
                        </div>  </td>
                        <td valign="top">
                        <span class="intp-Span" style="vertical-align: top;">
                            <?php echo $form->input("SurveyAction.action_title", array("class" => "inpt-txt-fld form-control",'label'=>false));?>  
                        </span>
                    </td>
                </tr>
            </table>
            <br />
            <div class="top-bar" style="text-align: left; padding-top: 5px; ">
            	<b><span style="color: red;">*</span> Required Field</b>
            </div>
            <?php echo $form->end(); ?>
    <!--inner-container ends here-->
</div>
</div>
<div class="clear"></div>