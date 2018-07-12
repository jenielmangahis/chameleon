<script type="text/javascript">
$(document).ready(function() {
$('#type').removeClass("butBg");
$('#type').addClass("butBgSelt");
}); 
</script>
<?php $lgrt = $session->read('newsortingby');?>
<?php ?>

<div class="titlCont"><div style="width:960px;  height:350; margin:0 auto">
                
<div align="center" class="slider" id="toppanel" style="height: 20px; top:13px;right: -50px;width:545px !important; text-align:right;">	
<?php  echo $form->create("Admins", array("action" => "addcommenttype",'name' => 'addcommenttype', 'id' => "addcommenttype",'onsubmit' => 'return validatecommenttype("add");'));
         if($returnurl){ echo $form->hidden("returnurl", array('id' => 'returnurl', 'value'=>$returnurl)); }
         if(!empty($closeit)=="yes"){   echo $form->hidden("closeit", array('id' => 'closeit', 'value'=>$closeit)); }
        ?>  
<button type="submit" value="Submit" class="sendBut" name="data[Action][redirectpage]"><?php e($html->image('save.png')); ?></button>
<button type="submit" value="Submit" class="sendBut" name="data[Action][noredirection]"><?php e($html->image('apply.png')); ?></button>		
<?php
e($html->link($html->image('cancle.png', array('alt' => 'Cancle')) . ' ',array('controller'=>'admins','action'=>'suggestedcomments'),array('escape' => false)));

?>
<?php  echo $this->renderElement('new_slider');  ?>
	
</div>

        <span class="titlTxt">Add Comment Type </span>



        <div class="topTabs" style="height:25px;">               
		 <?php /*?><ul>
                <li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
                <li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
                    <li>
				<?php
				e(
					$html->link(
						$html->tag('span','Cancel'),
						array('controller'=>'admins','action'=>'suggestedcomments'),
						array('escape'=>false)
					)
				);
				?>
				</li>
               <!--  <li><a href="/<?php echo $lgrt;?>"><span>Cancel</span></a></li>-->
            </ul><?php */?>
        </div>
    </div></div>
<div class="top-bar" style="border-left:0px;">
</div><br />

<div class="midPadd">
    <div>

        <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>


        <div class="top-bar" style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);">

        </div>
        <!-- ADD Sub Admin FORM BOF -->

        <!-- ADD FIELD BOF -->


        <table width="450px" align="left" cellpadding="1" cellspacing="1">
            <tr>
                <td colspan='3'><?php if($session->check('Message.flash')){ $session->flash(); }
                        echo $form->error('CommentType.comment_type_name', array('class' => 'errormsg'));

                ?></td>
            </tr>
            <tr ><td align="right" class="lbltxtarea"><label class="boldlabel">Comment Type <span class="red">*</span></label></td>
                <td><span class="intpSpan"><?php echo $form->input("CommentType.comment_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
            </tr>
            <tr><td class="lbltxtarea" align="right"><label class="boldlabel">Comment Type Purpose</label>&nbsp;&nbsp;</td>
                <td><span class="txtArea_top"><span class="newtxtArea_bot"><?php echo $form->input("CommentType.comment_type_purpose", array('id' => 'comment_type_purpose', 'div' => false, 'label' => '',"class" => "noBg",'rows'=>'5','cols'=>'26'));?></span></span></td>
            </tr>

            <!-- ADD FIELD EOF -->  	
            <!-- BUTTON SECTION BOF -->  
            <tr><td colspan="2">
                    <div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
                        <?php  echo $this->renderElement('bottom_message');  ?>
                    </div>
                </td></tr>

        </table>


        <?php echo $form->end();?>



        <!-- ADD Sub Admin  FORM EOF -->

    </div>
    <br>
</div><!--inner-container ends here-->

  







</div><!--container ends here-->

 <div class="clear"></div>
 
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
