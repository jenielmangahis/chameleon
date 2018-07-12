<?php 
	$base_url = Configure::read('App.base_url');
	$lgrt = $base_url.$session->read('newsortingby');
?>
<div class="titlCont1">
<?php  echo $form->create("Companies", array("action" => "addcommenttype",'name' => 'addcommenttype', 'id' => "addcommenttype",'onsubmit' => 'return validatecommenttype("add");'));
  if($returnurl){ echo $form->hidden("returnurl", array('id' => 'returnurl', 'value'=>$returnurl)); }
         if(!empty($closeit)=="yes"){   echo $form->hidden("closeit", array('id' => 'closeit', 'value'=>$closeit)); }
?>
       <div align="center" id="toppanel" >
        <?php 
		# set help condition

		App::import("Model", "HelpContent");

		$this->HelpContent =  & new HelpContent();

		$condition = "HelpContent.id = '49'";  

		$hlpdata= $this->HelpContent->find('all',array("conditions"=>$condition));

		$this->set("hlpdata",$hlpdata);

		# set help condition   
 echo $this->renderElement('new_slider');  ?>
</div>
<div class="myclass">
  <span class="titlTxt" >Add Comment Type </span>
        <div class="topTabs" >
                <ul>
              	 <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
		 <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
          <li><button type="button" id="cancelForm" class="button"  <?php if($returnurl){ echo "onclick='closemywindow();'"; }else{?>ONCLICK="javascript:(window.location='<?php echo $lgrt;?>')" <?php } ?>><span> Cancel</span></button></li> 
             <!--   <li><a href="/<?php echo $lgrt;?>"><span>Cancel</span></a></li>-->
                </ul>
        </div>
</div>
</div>


 
  <div class="boxPad">
  <div class="">
<div style="width: 960px; height:350px; margin: 0pt auto; align:left;" id="newaddcmttype">     
 
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<!-- ADD Sub Admin FORM BOF -->
                  
                     <!-- ADD FIELD BOF -->

		<?php //echo $form->create("Companies", array("action" => "addcommenttype",'name' => 'addcommenttype', 'id' => "addcommenttype",'onsubmit' => 'return validatecommenttype("add");'))?>
		<table width="450px" align="center" cellpadding="1" cellspacing="1">
		<tr>
			<td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
								echo $form->error('CommentType.comment_type_name', array('class' => 'errormsg'));
						
						?></td>
		</tr>
		<tr><td align="right" class="lbltxtarea"><label class="boldlabel">Comment Type <span class="red">*</span></label></td>
				<td><span class="intpSpan"><?php echo $form->input("CommentType.comment_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" =>"inpt_txt_fld","maxlength" => "200"));?></span></td>
	        </tr>
		<tr><td class="lbltxtarea" align="right"><label class="boldlabel">Comment Type Purpose </label>&nbsp;</td>
		<td><span class="txtArea_top"><span class="newtxtArea_bot"><?php echo $form->input("CommentType.comment_type_purpose", array('id' => 'comment_type_purpose', 'div' => false, 'label' => '',"class" => "noBg",'rows'=>'5','cols'=>'25'));?></span></span></td>
	        </tr>
	   
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2" height="100px">		 		
</td></tr>

	
	    </table>

<?php echo $form->end();?> <div class="top-bar" style="text-align: left;  padding: 20px 5px 5px 60px; ">
 <?php  echo $this->renderElement('bottom_message');  ?>                                </div>
					
					<!-- ADD Sub Admin  FORM EOF -->

			</div></div>
 
<!--inner-container ends here-->

  






<!--container ends here-->
     <script type="text/javascript">
    $(document).ready(function(){

        if($("#closeit")){
            isclose=$("#closeit").val();
            if(isclose=="yes"){       
                // This function from `Parent window 
                window.opener.GetCommentTypeRefresh();
                window.close();
            }
        }
    });

    function closemywindow(){       
        window.opener.GetCommentTypeRefresh();
        window.close();
    }

   
</script>

<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("newaddcmttype").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
