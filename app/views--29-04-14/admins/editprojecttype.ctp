<?php 
$base_url_admin = Configure::read('App.base_url_admin');
$backUrl = $base_url_admin.'projecttype';
?>

<div class="titlCont1"><div style="width:960px;margin:0 auto">
<?php echo $form->create("Admins", array("action" => "editprojecttype/$prid",'name' => 'editprojecttype', 'id' => "editprojecttype",'onsubmit' => 'return validateprojecttype("edit");'))?>
       <div align="center" id="toppanel" >
        <?php  echo $this->renderElement('new_slider');  ?>
</div>

  <span class="titlTxt">Edit Project Type </span>
        
<div class="topTabs">
<ul>
<li><button type="submit" value="Submit" class="button" name="data[Action][redirectpage]"><span>Save</span></button></li>
<li><button type="submit" value="Submit" class="button" name="data[Action][noredirection]"><span>Apply</span></button></li>
<li><a href="<?php echo $backUrl;?>"><span>Cancel</span></a></li>
</ul>
</div>
</div></div>


<div class="boxBor1">
  <div class="boxPad">
  <div class="">

<div id="addprtype" style="width: 960px; height:300px; margin: 0pt auto; align:left;">        
 
<?php if($session->check('Message.flash')) { echo $this->renderElement('error_message'); } ?>

<div>

		
		<table width="600px" height="250px" align="left" cellpadding="1" cellspacing="1">
		<tr>
			<td colspan='3'><?php 
							    echo $form->hidden("SiteType.id", array('id' => 'typeid'));
						?></td>
		</tr>
		<tr><td align="right"><label class="boldlabel">Project Type <span style="color:red">*</span></label></td>
				<td><span class="intpSpan"><?php echo $form->input("SiteType.project_type_name", array('id' => 'typename', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","maxlength" => "200"));?></span></td>
	        </tr>
	   
	        <tr><td valign='' align="right"><label class="boldlabel">Note</label>&nbsp;</td>
				<td><span class="txtArea_top">
<span class="newtxtArea_bot"><?php echo $form->textarea("SiteType.notes", array('id' => 'notes', 'div' => false, 'label' => '','cols' => '35', 'rows' => '4',"class" => "multilist"));?></span></span></td>
	       </tr>
	       
 		<!--<tr><td><label class="boldlabel">Coins Held By Multiple Holders ?</label></td>
				<td><?php echo $form->hidden('SiteType.istransferable', array('type'=>'checkbox', 'label' => '','onchange'=>'checkboxfun()')); ?></td>
	       </tr>
		<tr><td><label class="boldlabel">Simple Coin Transfer</label></td>
				<td><?php echo $form->hidden('SiteType.simple_cointransfer', array('type'=>'checkbox', 'label' => '','onchange'=>'checkboxfun()')); ?></td>
	       </tr>
		<tr><td><label class="boldlabel">Registration with Coin # Required?</label></td>
				<td><?php echo $form->hidden('SiteType.coin_verification', array('type'=>'checkbox', 'label' => '')); ?></td>
	       </tr>
		<tr><td><label class="boldlabel">Show Comments Navigation Button</label></td>
				<td><?php echo $form->hidden('SiteType.showcommentbutton', array('type'=>'checkbox', 'label' => '')); ?></td>
	       </tr>
		<tr><td><label class="boldlabel">Show Comments to everyone</label></td>
				<td><?php echo $form->hidden('SiteType.iscommentpublic', array('type'=>'checkbox', 'label' => '')); ?></td>
	       </tr>	
		<tr><td><label class="boldlabel">Suggested Comment Types      Maximum # of comments per Holder--><!--</label></td>-->
				<!--<td><?php
				App::import("Model", "CommentType");
				$this->CommentType =   & new CommentType();
				
				
				$maxnumbercomment= $this->CommentType->find('count',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0'", 'order' =>"id"));

				$maxcomarr=array();
				for($j=1;$j<$maxnumbercomment;$j++)
				$maxcomarr[$j]=$j;

				echo $form->select("SiteType.maxnumbercomment",$maxcomarr,$selectedend_after,array('id' => 'maxnumbercomment','style'=>'width:40px','onchange'=>'hidetextboxes()'),false); ?> 
			</td>
			<tr><td>&nbsp;</td>
				<td>
				<?php
				App::import("Model", "CommentType");
				$this->CommentType =   & new CommentType();
				
				$i=0;
				$commenttypedata = $this->CommentType->find('all',array("conditions"=>"CommentType.active_status='1' and CommentType.delete_status='0'", 'order' =>"id"));
				$commenttypedropdown = Set::combine($commenttypedata, '{n}.CommentType.id', '{n}.CommentType.comment_type_name');
				
				foreach($commenttypedata as $eachrow){
				$i++;
					App::import("Model", "ProjectCommentType");
					$this->ProjectCommentType =   & new ProjectCommentType();

					$comment_type_id = $this->ProjectCommentType->find('first',array("conditions"=>"ProjectCommentType.project_type_id=$SiteTypeId and ProjectCommentType.sequence_id=".$i." and ProjectCommentType.active_status='1' and ProjectCommentType.delete_status='0'", 'fields' =>"comment_type_id"));

					echo $form->input("SiteType.commenttype".$i, array('id' => 'commenttype'.$i, 'div' => false, 'label' => '',"class" => "contactInput","style"=>"width:20px","maxlength" => "3",'value'=>$i));
					echo $form->select("SiteType.commenttypeoption".$i,$commenttypedropdown,$comment_type_id['ProjectCommentType']['comment_type_id'],array('id' => 'commenttypevalue'.$i, 'div' => false, 'label' => ''),array('0'=>'--Select--')); 
					echo "<br/>";
				}
				?></td>
	       </tr>
		<tr><td><label class="boldlabel">Additional Comments allowed:</label></td>
				<td><?php echo $form->hidden('SiteType.additional_comment', array('type'=>'checkbox', 'label' => '','div'=>false));
					echo "&nbsp;&nbsp;&nbsp;&nbsp;";echo $form->select("additionalcomment",array('0'=>'Misc.Additional Comment'),0,array('id' => 'additionalcomment'),false); ?></td>
	       </tr>
		<tr><td><label class="boldlabel">RSVP Required</label></td>
				<td><?php echo $form->hidden('SiteType.is_rsvp', array('type'=>'checkbox', 'label' => '')); ?></td>
	       </tr>-->
	     
          <!-- <tr><td align="right" width="50%"><label class="boldlabel">Default Delivery Days After Order Date</label>&nbsp;</td>
				<td><span class="intpSpan"><?php echo $form->input("SiteType.defaultdeliverydays", array('id' => 'defaultdeliverydays', 'div' => false, 'label' => '',"class" => "inpt_txt_fld","style"=>"width:40px","maxlength" => "3"));?></td>
	       </tr> -->
		     <!-- ADD FIELD EOF -->  	
                     <!-- BUTTON SECTION BOF -->  
        <tr><td colspan="2"><div style="margin-bottom: 10px; text-align: left; padding-top: 5px; color:black" class="top-bar">
           <?php  echo $this->renderElement('bottom_message');  ?>
            </div></td></tr>
		
	
	    </table>  
<?php echo $form->end();?>					
					<!-- ADD Sub Admin  FORM EOF -->				
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
			</div></div> 
</div><!--inner-container ends here-->
<div class="clear"></div>
</div><!--container ends here-->

<div class="clear"></div>

<script type="text/javascript">
	if(document.getElementById("flashMessage")==null)
		document.getElementById("addprtype").style.paddingTop = '24px';
	else
	{
			document.getElementById("blck").style.paddingTop = '10px';
	}	
</script>
