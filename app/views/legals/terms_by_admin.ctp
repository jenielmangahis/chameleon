<?php //debugbreak();
$server_path=$_SERVER['REQUEST_URI'];
$server_para=explode('/',$server_path);
$opr=$server_para[3];
$id=$server_para[4];

$base_url = Configure::read('App.base_url');
$backUrl = $base_url.'setups/super_admin_changepassword';
?>
<?php  echo $javascript->link('ckeditor/ckeditor'); ?>
<!-- Body Panel starts -->
<div class="titlCont"><div class="myclass">
<div align="center" class="slider" id="toppanel">
     <?php  echo $this->renderElement('new_slider');  ?>


</div>
<?php echo $form->create("legals", array("action" => "terms_by_admin/".$opr."/".$id,'name' => 'terms_by_admin', 'id' => "terms_by_admin")); 
echo $form->hidden("Term.id", array('id' => 'termid'));
?>

<span class="titlTxt1">&nbsp;</span>    
<span class="titlTxt">
Terms &amp; Privacy Edit
</span>
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><button type="button" id="saveForm" class="button"  ONCLICK="javascript:(window.location='<?php echo $backUrl ?>')"><span> Cancel</span></button></li>
</ul>
</div>
<div class="clear"></div>
         <ul class="topTabs2" id="tab-container-1-nav" style="padding-left: -40px;">
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Agreements by Project'),
			array('controller'=>'legals','action'=>'user_agreement_list_by_project'),
			array('escape' => false,'class'=>'')
			)
		);
		?>
		</li>
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'User Agreement'),
			array('controller'=>'legals','action'=>'user_agreement_list'),
			array('escape' => false,'class'=>'')
			)
		);
		?>
		</li>
		<li>
		<?php
		e($html->link(
			$html->tag('span', 'Agree History'),
			array('controller'=>'legals','action'=>'user_agreehistory'),
			array('escape' => false,'class'=>'user_agreehistory')
			)
		);
		?>
		</li>
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Spam Policy'),
			$spam_policy_url,
			array('escape' => false,'class'=>'')
			)
		);
		?>
		</li>
        <li>
		<?php
		e($html->link(
			$html->tag('span', 'Terms & Privacy'),
			$terms_url,
			array('escape' => false,'class'=>'tabSelt')
			)
		);
		?>
		</li>
        </ul>
</div></div>
<div class="midPadd" id="logintab">
 <!-- <p class="boxTop1"><?php //echo $html->image('/img/'.$project_name.'/rhtBox_top.gif', array('class'=>'right'));?></p>-->
<div>    



             <?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<!-- <div class="top-bar" style="border-left: 0px none; text-align: right; padding-top: 5px; color: rgb(255, 255, 255);">-->
    
   </div>
        <table cellspacing="5" cellpadding="0" align="center" width="100%">
          <tbody>
            <?php
                
             if($session->check('Message.flash')){ ?> 
            <tr><td colspan="2" align="center">
                    <?php $session->flash(); ?> 
            </td>
            </tr>
            <tr><td colspan="2" align="center">&nbsp;</td></tr>
            <?php } ?>
          
            <tr>
              <td colspan='2'><b> Terms </b></td>
            </tr>
			<?php /* ?>
			<tr>
             <td width="10%" align="right"><label class="boldlabel">Title <span style="color: red;">*</span></label></td>
             <td width="90%"><span class="intpSpan"><?php echo $form->input("Term.termstitle", array('id' => 'termstitle', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
            </tr>
			<?php */ ?>
			
            <tr>
              <td width="100%" colspan=2 style="vertical-align:top" ><!--<label class="boldlabel">Content: <span style="color: red;">*</span></label>-->
            <?php //echo $form->textarea("Term.termscontent", array('id' => 'termscontent', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "contactInput"));?>
            <?php    
                        /*echo $form->create('Term');  
                        echo $form->input('termscontent', array('cols' => '50', 'rows' => '100','label'=>false,'div'=>false,'class'=>'contactInput','style'=>"width:400px")); 
                        echo $fck->load('Term/termscontent','540','600'); 
                        echo $form->input('id', array('type'=>'hidden'));*/
                        echo $form->textarea('Term.termscontent', array('id'=>'termscontent','class'=>'ckeditor'));                        
                        
                ?>
            </td>
            </tr>    
            
            
            <tr>
              <td ><b> Privacy </b></td>
            </tr>
			<?php /* ?>	
            <tr>
             <td width="10%" align="right"><label class="boldlabel">Title <span style="color: red;">*</span></label></td>
             <td  width="90%"><span class="intpSpan">
                <?php echo $form->input("Term.privacytitle", array('id' => 'privacytitle', 'div' => false, 'label' => '','style' =>'width:400px;',"class" => "inpt_txt_fld","maxlength" => "250"));?></span></td>
			</tr>
			<?php */ ?>
             <tr>
              <td width="100%" colspan=2 style="vertical-align:top"><!--<label class="boldlabel">Content: <span style="color: red;">*</span></label>-->
              <?php //echo $form->textarea("Term.privacycontent", array('id' => 'privacycontent', 'div' => false, 'label' => '','cols' => '24', 'rows' => '4',"class" => "contactInput"));?>
				<?php                        
                       echo $form->textarea('Term.privacycontent', array('id'=>'privacycontent','class'=>'ckeditor'));              ?>
            </td>
            </tr>    
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
             <td colspan='5' style="border-left: 0px none; text-align: left; padding-top: 5px; " class="top-bar">
 
   </td>

             </tr>    
        </tbody>
        </table>
    
        <?php echo $form->end();?><div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
           <?php  echo $this->renderElement('bottom_message');  ?>
            </div><br>
</div></div> </div>
 
<!--inner-container ends here-->

<div></div>
  
<div class="clear"></div>

  <!-- Body Panel ends --> 
<script type="text/javascript">
    if(document.getElementById("flashMessage")==null)
        document.getElementById("logintab").style.paddingTop = '24px';
    else
    {
            document.getElementById("blck").style.paddingTop = '10px';
    }    
</script>
