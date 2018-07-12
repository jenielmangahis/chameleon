<?php if($showsurvey) {?>
<style>
.rightbotimg{
	background: none repeat scroll 0% 0% rgb(255, 255, 255); text-align: center; padding: 10px 0;
}
.rightbotimg li{
	float: left; padding:7px;
}
.ulclass{
	list-style:none;
}
.loadCls{
    background: url("../../../img/enq-loading.gif") top center no-repeat;padding-top:52px;
}
</style>
<div class="rightbotimg" id="sumanTest">
<?php if($recid && $this->data['Survey']){ ?>
       <div class="boxBor">
       <div class="boxPad">
	   <div class="rightbotimg">
       <div><span align='center'><?php if($session->check('Message.flash')){ $session->flash(); } ?> </span>
       <div class="clear"></div>
       </div>
         <?php echo  $form->create('Company',array('action'=>'surveyaction', "onsubmit"=>"return validate_surveyform();" ,"target"=>"_parent"  )); ?>
         <input type="hidden" id="id" name="id" value="<?php echo $recid; ?>" />
          <input type="hidden" id="member_id" name="member_id" value="<?php echo $member_id; ?>" />
         <table cellpadding='3' cellspacing='0' align='center' width='100%'>
         <tbody>
         	<tr>
         		<td colspan="2">
       	 	<?php echo $this->data['Survey']['form_html'];  ?>
       	 		</td>
       	 	</tr>
           <tr>  
           <td width='40%' align='right' valign='top'>  </td>
           <td width='60%' align="left"> <span>
                         <span class="flx_button_lft ">
                         <?php echo $form->submit('Submit', array('div'=>false,"class"=>"flx_flexible_btn", "name"=>'send'));?> 
                         </span>
                         
                     </span>
           </td>
           </tr>
         </tbody></table>       
                
         <div align="center">
             <?php  //echo $strFormHtml; //$this->data['FormType']['form_html'];  ?>
         </div>
        <?php echo $form->end();?> 
	  <div class="clear"></div>
	  </div>
          
        </div>
    </div>
	  <?php 
} else{
    ?>
    <div style=" text-align: center; ">
     Could not complete the operation. <br/> One or more parameter values are not valid OR  required parameter is missing. 
    </div>
    <?php
}?>
</div>

<script type="text/javascript">

      function validate_surveyform(){

		for(var i =0; i < 6; i++){
			if($('#'+i).hasClass('required')){
				if(trim($('#'+i).val())==''){
		    		inlineMsg( $('#'+i).attr('id'),'<strong>Required.</strong>',2);
		    		return false;
    		  	}
			}
		}
        return true;
        
      }   
</script>
<?php } ?>